# 🏫 Boss Learning - Multi-Tenant School Management SaaS

Welcome to **Boss Learning**, a premium, multi-tenant School Management System and Software-as-a-Service (SaaS) platform. This repository contains the complete ecosystem, including the Laravel administrative backend, the Flutter Student/Parent mobile & web application, and the Flutter Staff/Teacher mobile application.

---

## 🚀 System Architecture & Components

The **Boss Learning** suite consists of three core components:

1. **Boss Learning Administrative Portal (Backend)**: Built with Laravel, managing multi-tenant database routing (one database per school tenant) and the global Super Admin configuration panel.
2. **Boss Learning Student App (Frontend)**: Built with Flutter, supporting Web (HTML5/Wasm), Android, and iOS.
3. **Boss Learning Staff App (Frontend)**: Built with Flutter, supporting Android and iOS.

---

## 🛠️ Technology Stack

* **Backend & API**: PHP 8.x | Laravel 9.x / 10.x | MySQL (Multi-tenant DB structure)
* **Mobile & Web Apps**: Dart | Flutter SDK (3.x) | State Management: Bloc / Provider
* **Web Frontend Integration**: Vite / Webpack Mix for asset bundling

---

## 📂 Codebase Directory Structure

```text
├── app/                  # Laravel Backend Application Logic
├── bootstrap/            # Laravel Bootstrapping Files
├── config/               # Laravel Global Configurations
├── database/             # Migrations, Seeders, and Tenant Database Setup
├── flutter_staff_app/    # Flutter Staff/Teacher Mobile Application
├── flutter_student_app/  # Flutter Student/Parent Mobile & Web Application
├── lang/                 # Localization / Translation Files
├── packages/             # Custom Laravel packages and add-ons
├── public/               # Web Root (Vite/Webpack assets, index.php)
├── resources/            # Blade Views, Sass, JavaScript assets
├── routes/               # API, Web, and Tenant Route Definitions
├── storage/              # Logs, Cache, and User uploads
└── vendor/               # Laravel Composer dependencies

---

## 📦 Last Update

- **Date:** 2026-06-07
- **Changed/Updated files:** `composer.json`, `package.json`, `flutter_student_app/lib/ui/styles/colors.dart`, `flutter_staff_app/lib/ui/styles/colors.dart`, and various Laravel theme defaults and assets (seeders/migrations/views).

If you want a more detailed changelog entry (per-package versions or migration notes), tell me which files or packages to expand.