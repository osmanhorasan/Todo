"use client";
import { fetchTasksAPI } from "@/utils/api";
import { useEffect, useState } from "react";

interface Task {
  id: number;
  name: string;
  duration: number;
  difficulty: number;
  assignedDeveloper?: string; // Optional if it might not be present
}

const TaskPlanner = () => {
  const [tasks, setTasks] = useState<Task[]>([]); // Define the state type as Task[]

  useEffect(() => {
    fetchTasks();
  }, []);

  const fetchTasks = async () => {
    try {
      const response = await fetchTasksAPI()
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      const data = await response.json();
      setTasks(data);
    } catch (error) {
      console.error("Error fetching tasks:", error);
    }
  };

  return (
    <div className="flex min-h-screen items-center justify-center">
      <div className="overflow-x-auto bg-white shadow-md rounded-xl">
        <h1 className="text-center bg-slate-200 py-2 text-xl uppercase">
          Haftalık İş Planı
        </h1>
        <table className="min-w-full ">
          <thead>
            <tr className="bg-blue-gray-100 text-gray-700">
              <th className="py-3 px-4 text-left">#</th>
              <th className="py-3 px-4 text-left">Görev</th>
              <th className="py-3 px-4 text-left">Süre</th>
              <th className="py-3 px-4 text-left">Zorluk</th>
              <th className="py-3 px-4 text-left">Atanan Geliştirici</th>
            </tr>
          </thead>
          <tbody className="text-blue-gray-900">
            {tasks.map((task) => (
              <tr className="border-b border-blue-gray-200" key={task.id}>
                <td className="py-3 px-4">{task.id}</td>
                <td className="py-3 px-4">{task.name}</td>
                <td className="py-3 px-4">{task.duration}</td>
                <td className="py-3 px-4">{task.difficulty}</td>
                <td className="py-3 px-4">{task.assignedDeveloper}</td>
              </tr>
            ))}
          </tbody>
        </table>
        <div className="w-full pt-5 px-4 mb-8 mx-auto ">
          <div className="text-sm text-gray-700 py-1 text-center">
            <a
              className="text-gray-700 font-semibold"
              href="https://www.material-tailwind.com/docs/html/table/?ref=tailwindcomponents"
              target="_blank"
            >
              Osman HORASAN
            </a>{" "}
            Tarafından{" "} Yapılmıştır.
            .
          </div>
        </div>
      </div>
    </div>
  );
};

export default TaskPlanner;
