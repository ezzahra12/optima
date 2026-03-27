# 🚀 Optima ERP - Système de Gestion Intégrée

**Optima** est une application de gestion d'entreprise (ERP) développée avec **Laravel 11**. Elle permet de centraliser la gestion des ressources humaines, le suivi des projets, et le contrôle des stocks/transactions.

## 📌 Fonctionnalités principales

- **Gestion RH :** Administration des employés, des départements et suivi des absences.
- **Gestion de Projets :** Création de projets, découpage en tâches et assignation aux collaborateurs.
- **Gestion de Stock :** Suivi des produits avec système d'alerte automatique en cas de stock faible.
- **Finance :** Enregistrement et validation des transactions par le pôle comptabilité.

## 🛠️ Stack Technique

- **Framework :** [Laravel 11](https://laravel.com)
- **Langage :** PHP 8.2+
- **Base de données :** MySQL / MariaDB
- **Frontend :** Blade & Tailwind CSS (Vite)
- **Gestion de version :** Git & GitHub

## 📊 Diagramme de Classes (UML)

Le projet est basé sur une architecture orientée objet robuste incluant :
- **Héritage :** Utilisateur -> Employé -> (Comptable, RH, Chef de Projet).
- **Relations :** One-to-Many (Département/Employés), Many-to-Many (Employés/Tâches), Composition (Projet/Tâches).

## 🚀 Installation

1. Cloner le projet :
   ```bash
   git clone [https://github.com/TON_USERNAME/optima.git](https://github.com/TON_USERNAME/optima.git)
