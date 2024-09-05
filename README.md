# BP Monitoring System

A Laravel-based application for monitoring patient vitals, including blood pressure and pulse rate, with integrated caregiver and patient dashboards.

## Features

- **Caregiver Dashboard**: View and manage patients assigned to the caregiver.
- **Patient Dashboard**: View medical data, including vital signs and medical history.
- **Device Management**: Track devices associated with patients.
- **Vitals Tracking**: Record and display vital signs with timestamps.

## Installation

### Requirements

- PHP 8.0 or higher
- Composer
- MySQL or other compatible database
- Node.js and npm (for managing frontend assets)

### Steps to Set Up

1. **Clone the Repository**

   ```bash
   git clone https://github.com/your-username/bp-monitoring-system.git
   cd bp-monitoring-system
   ```

2. **Install PHP Dependencies**

   ```bash
   composer install
   ```

3. **Set Up Environment File**

   Copy `.env.example` to `.env` and update database and other settings as needed.

   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**

   ```bash
   php artisan key:generate
   ```

5. **Run Migrations and Seeders**

   ```bash
   php artisan migrate --seed
   ```

6. **Install Node.js Dependencies**

   ```bash
   npm install
   ```

7. **Build Frontend Assets**

   ```bash
   npm run dev
   ```

8. **Serve the Application**

   ```bash
   php artisan serve
   ```

   The application will be available at `http://localhost:8000`.

## Configuration

- **Favicon**: Place your `favicon.png` in the `public` directory.
- **Background Image**: Add your background image to `public/images` and reference it in `resources/css/app.css`.

## Usage

- **Caregivers** can view and manage patients, including viewing their vital signs and medical history.
- **Patients** can view their medical data, vital signs, and the device assigned to them.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

## Acknowledgements

- Laravel Framework
- Tailwind CSS
- Faker for generating fake data
- MySQL Database

---

For more information or help, contact [psunday2000@gmail.com](mailto:psunday2000@gmail.com).
