# Baby-ahh-Task-Manager-

```markdown
# Task Manager

## Project Overview
Task Manager is a simple web application built with PHP that allows users to manage tasks efficiently. Users can create tasks, assign them to specific individuals, and track their status. The application utilizes a SQLite database to store users and task information, providing a straightforward interface to interact with the task management system.

## Installation
To set up the Task Manager application locally, follow these steps:

1. Clone the repository:
   ```bash
   git clone <[repository_url](https://github.com/abhi-mike-g/Baby-ahh-Task-Manager-)>
   ```

2. Navigate to the project directory:
   ```bash
   cd task-manager
   ```

3. Make sure you have PHP and a web server (like Apache or Nginx) installed. You can use a local server like XAMPP or MAMP for testing.

4. Open your terminal, navigate to the project folder, and run the following command to start the built-in PHP server:
   ```bash
   php -S localhost:8000
   ```

5. Access the application at http://localhost:8000 in your web browser.

## Usage
- To view existing tasks, navigate to the main page (index.php).
- To add a new task, click the "Add New Task" button, fill in the required fields, and submit the form.
- Tasks will automatically populate with user names and details such as due dates and statuses.

## Features
- **User Management**: Ability to assign tasks to users stored in the database.
- **Task Management**: Create tasks with titles, due dates, and track their statuses (pending, completed, etc.).
- **Audit Log**: Tracks task creation actions and logs them for auditing.
- **Interactive Interface**: Utilizes Bootstrap for responsive design, ensuring good usability on various devices.

## Dependencies
This project does not have any external dependencies as there is no package.json found. It relies on PHP and SQLite which are both server-side technologies included in most PHP installations.

## Project Structure
```
.
├── config.php           # Database connection and table setup
├── index.php            # Main interface displaying tasks
├── add_task.php         # Form for adding new tasks
```

### File Descriptions:
- **config.php**: Contains database connection logic, creates tables if they do not exist, and inserts a sample user if the users table is empty.
- **index.php**: The main page that displays a list of tasks, their statuses, and allows navigation to the task addition page.
- **add_task.php**: A form used to collect user input for new tasks, including task title, due date, and user selection.

With this application, managing tasks has never been easier. Enjoy using the Task Manager!
```
