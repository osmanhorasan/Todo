// utils/api.js
export const fetchTasksAPI = async () => {
    const response = await fetch('http://127.0.0.1:8000/api/tasks');
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response;
};
