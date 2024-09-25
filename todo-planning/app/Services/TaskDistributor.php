<?php
// app/Services/TaskDistributor.php
namespace App\Services;

use App\Models\Task;
use App\Models\Developer;

class TaskDistributor
{
    public function distributeTasks()
    {
        $developers = Developer::all();
        $tasks = Task::all();

        // Haftalık çalışma süresi (saat)
        $weeklyHours = 45;

        // Geliştiricilerin haftalık kapasiteleri
        $developerCapacities = [];
        foreach ($developers as $developer) {
            $developerCapacities[$developer->id] = [
                'capacity' => $developer->difficulty * $weeklyHours,
                'allocatedHours' => 0,
                'tasks' => []
            ];
        }

        // Görevleri sırayla geliştiricilere atama
        foreach ($tasks as $task) {
            // Görevin süresi
            $taskHours = $task->duration;

            // En az iş yükü olan uygun geliştiriciyi bul
            $bestDeveloperId = null;
            $minAllocatedHours = PHP_INT_MAX; // En küçük iş yükünü tutmak için başlangıç değeri

            foreach ($developerCapacities as $developerId => $capacityInfo) {
                // Eğer geliştiricinin kapasitesi, görevin süresini karşılayabiliyorsa
                if ($capacityInfo['allocatedHours'] + $taskHours <= $capacityInfo['capacity']) {
                    // Şu ana kadar en az atanmış saatlere sahip olan geliştiriciyi bul
                    if ($capacityInfo['allocatedHours'] < $minAllocatedHours) {
                        $minAllocatedHours = $capacityInfo['allocatedHours'];
                        $bestDeveloperId = $developerId;
                    }
                }
            }

            // Eğer uygun bir geliştirici bulunduysa görevi atama
            if ($bestDeveloperId !== null) {
                $developerCapacities[$bestDeveloperId]['allocatedHours'] += $taskHours;
                $developerCapacities[$bestDeveloperId]['tasks'][] = $task;
            } else {
                // Eğer hiçbir geliştirici görevi alamıyorsa, bir hata yönetimi yapabilirsin
                // echo "Görev {$task->name} için uygun geliştirici bulunamadı.\n";
            }
        }

        // Sonuçları döndür
        return $developerCapacities;
    }
}
