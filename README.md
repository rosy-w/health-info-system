# Health Information Management System

A Laravel app for managing clients, health programs, and enrollments in a healthcare setting.

## Requirements from the software engineering task
This solution should allow a doctor (system user) to do the following:
1.	Create a health program – e.g., TB, Malaria, HIV, etc.
2.	Register a new client in the system.
3.	Enroll a client in one or more programs.
4.	Search for a client from a list of registered clients.
5.	View a client's profile, including the programs they are enrolled in.
6.	Expose the client profile via an API, so that other systems can retrieve this information.

##Features

- Dashboard with metrics and quick actions
- Manage clients, health programs, and enrollments
- Role-based access (doctor(user), admin)
- Responsive UI (Tailwind CSS + Font Awesome)
- Live search (Alpine.js)
- REST API (Sanctum)

---

## Quickstart

1. **Clone the repo & install deps**
    ```bash
    git clone https://github.com/rosy-w/health-info-system.git
    cd health-info-system
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate
    ```

2. **Set your `.env` database credentials**

3. **Migrate & Seed database**
    ```bash
    php artisan migrate:fresh --seed
    ```

4. **Start the app**
    ```bash
    php artisan serve
    npm run dev
    ```

5. **Login**
    - Visit [http://127.0.0.1:8000](http://127.0.0.1:8000)
    - Use demo credentials from `database/seeders/UserSeeder.php`
      - *(e.g. doctor@example.com / doctor)*

---

## License

MIT © Rosy Waruku
