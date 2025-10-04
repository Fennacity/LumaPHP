# 🌙 LumaPHP

**LumaPHP** is a lightweight and flexible PHP framework that helps developers build web applications **faster** and **more efficiently** — without the unnecessary complexity. It’s designed to be **simple**, **customizable**, and **extendable**, giving you the essentials you need while staying completely open to modification.

---

## ✨ Features

- **Lightweight Core** – Only the essentials, no bloat  
- **Fast & Efficient** – Clean structure that keeps performance high  
- **Customizable** – Modify or extend any part of the framework  
- **Developer-Friendly** – Straightforward and easy to learn  
- **Modern PHP** – Built with clarity and simplicity in mind  

---

## 🚀 Getting Started

### 1. Clone the Framework

You can get started by cloning the repository:

```
git clone https://github.com/yourusername/LumaPHP.git myapp
```

Or download it directly as a ZIP file.

### 2. Run Your First App

Inside the project folder, create an `index.php` file (or use the provided example):

```
<?php
require_once 'core/App.php';
require_once 'core/Route.php';

use Luma\Core\App;
use Luma\Core\Route;

$app = new App();

Route::get('/', function () {
    return 'Hello from LumaPHP!';
});

$app->run();
```

Then open it in your browser:

```
http://localhost/myapp/public
```

---

## 🧠 Directory Structure

```
/app
/config
/core
/public
/routes
/storage
```

Each folder is optional — LumaPHP is flexible enough to work with whatever structure fits your project.

---

## ⚙️ Configuration

Configuration files are stored in the `/config` folder.  
Every file handles a single concern (routes, database, environment, etc.).  

You can modify any part of the framework’s core — it’s built to be fully editable and understandable at a glance.

---

## 🧩 Extending LumaPHP

LumaPHP is built for developers who like to stay in control.  
You can easily add or replace any part of the system.

```
<?php
$app->register(new MyCustomProvider());
```

You’re free to extend the router, middleware, or even the core `App` class itself.

---

## 💬 Philosophy

> “Keep it light. Keep it clear. Keep it fast.”

LumaPHP exists to give developers freedom — freedom from heavy dependencies, rigid structures, and unnecessary complexity.  
It’s all about **simplicity**, **clarity**, and **speed**.

---

## 🔧 Requirements

- PHP 8.1 or higher  
- No Composer or external packages required  

---

## 🧑‍💻 Contributing

Contributions are always welcome!  
Open an issue, start a discussion, or submit a pull request to help improve LumaPHP.

---

## 🪶 License

LumaPHP is open-source software licensed under the [MIT license](LICENSE).

---

## 🌟 Tagline Ideas

You could use one of these or create your own:  
- “Build fast. Stay light.”  
- “The lightweight PHP framework that just makes sense.”  
- “Simple. Fast. Flexible.”  
- “Your clean start for modern PHP.”  
