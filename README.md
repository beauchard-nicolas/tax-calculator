# Calculateur d'Impôts UK

## Technologies Utilisées

### Backend
- PHP 8.2
- Laravel 10.x
- MySQL 8.0
- PHPUnit pour les tests unitaires

### Frontend
- Blade (moteur de template Laravel)
- Vite.js pour le bundling
- Tailwind CSS pour le styling

### Outils de Développement
- Composer pour la gestion des dépendances PHP
- npm pour la gestion des dépendances JavaScript
- Git pour le versioning
- PostCSS pour le traitement CSS

## À Propos du Projet

Ce projet réalisé dans le cadre d'un test technique est un calculateur d'impôts pour le Royaume-Uni développé en PHP et notamment avec Laravel. Il permet de calculer les impôts sur le revenu en fonction des tranches d'imposition britanniques avec des valeurs fictives.

### Fonctionnalités Principales

- Calcul d'impôts basé sur le salaire annuel brut
- Affichage détaillé des résultats incluant :
  - Salaire annuel et mensuel brut
  - Salaire annuel et mensuel net
  - Impôts annuels et mensuels
- Interface utilisateur intuitive
- Gestion des tranches d'imposition via base de données

### Structure des Tranches d'Imposition

| Tranche | Plage de Salaire Annuel (£) | Taux d'Imposition (%) |
|---------|----------------------------|---------------------|
| A       | 0 - 5,000                 | 0                   |
| B       | 5,000 - 20,000           | 20                  |
| C       | 20,000+                  | 40                  |

### Exemples de Calculs

#### Pour un salaire de 10,000£ par an :
- Tranche A (0-5,000£) : 5,000£ × 0% = 0£
- Tranche B (5,000-10,000£) : 5,000£ × 20% = 1,000£
- Tranche C : 0£ × 40% = 0£
- **Impôt total annuel = 1,000£**

#### Pour un salaire de 40,000£ par an :
- Tranche A (0-5,000£) : 5,000£ × 0% = 0£
- Tranche B (5,000-20,000£) : 15,000£ × 20% = 3,000£
- Tranche C (20,000-40,000£) : 20,000£ × 40% = 8,000£
- **Impôt total annuel = 11,000£**

## Guide d'Installation Détaillé

### 1. Prérequis
- PHP 8.2 ou supérieur
- Composer
- MySQL 8.0
- Node.js et npm
- Git

###  Installation

1. Prérequis
- PHP 8.2 ou supérieur
- Composer
- MySQL
- Node.js et npm

2. Cloner le repository

3. Installer les dépendances PHP et JS

4. Configurer votre environnement et la base de données

5. Exécuter les migrations vers votre base de données et compiler les assets

6. Lancer l'application et les tests