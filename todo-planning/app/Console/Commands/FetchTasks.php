<?php
// app/Console/Commands/FetchTasks.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use GuzzleHttp\Client;

class FetchTasks extends Command
{
    protected $signature = 'tasks:fetch';
    protected $description = 'Fetch tasks from providers';

    public function handle()
    {
        $client = new Client();
        $providers = [
            'https://gist.githubusercontent.com/firatozpinar/8b6ac47e177f07bd99046f873154cef3/raw',
        ];

        foreach ($providers as $provider) {
            try {
                $response = $client->get($provider);

                // API yanıtını kontrol et
                $jsonContent = $response->getBody()->getContents();

                // Yanıtı yazdır
                $this->info("Response from provider {$provider}: {$jsonContent}");

                // Fazladan virgül temizle ve JSON'u düzelt
                $jsonContent = rtrim($jsonContent); // Sonundaki boşlukları temizle
                if (substr($jsonContent, -1) === ',') {
                    $jsonContent = rtrim($jsonContent, ','); // Sonundaki fazladan virgülü temizle
                }
                $jsonContent .= ']}'; // Kapanış parantezlerini ekle

                // JSON verisini çözümle
                $data = json_decode($jsonContent);

                // JSON decode işleminin başarılı olup olmadığını kontrol et
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $this->error("JSON decode error from provider {$provider}: " . json_last_error_msg());
                    continue; // Bir sonraki provider'a geç
                }

                // İlk API'den dönen görevler
                if (isset($data->data) && is_array($data->data)) {
                    foreach ($data->data as $task) {
                        Task::create([
                            'name' => $task->title,
                            'duration' => $task->time,
                            'difficulty' => $task->level,
                            'provider_id' => $task->id,
                        ]);
                    }
                }
                // İkinci API'den dönen tek görev
                elseif (isset($data->data) && is_object($data->data)) {
                    $task = $data->data;
                    Task::create([
                        'name' => $task->title,
                        'duration' => $task->time,
                        'difficulty' => $task->level,
                        'provider_id' => $provider,
                    ]);
                } else {
                    $this->warn("No valid tasks found in provider {$provider}");
                }

            } catch (\Exception $e) {
                $this->error("Error fetching from provider {$provider}: " . $e->getMessage());
            }
        }
    }
}
