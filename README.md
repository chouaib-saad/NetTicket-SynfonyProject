# 🧾 NetTicket - Application Web de Gestion de Tickets de Caisse

NetTicket est une application web développée en PHP, destinée à la **gestion des tickets de caisse**, avec une interface back-office pour administrer les **caissiers**, **produits**, et **tickets**.

---

## ✅ Fonctionnalités principales

### 🎫 Gestion des Tickets
- Création de tickets avec numéro, produits, quantités, prix, montant total.
- Enregistrement dans la base de données (id, date, total...).
- Recherche et affichage des tickets.
- Mise à jour et annulation des tickets.

### 🛒 Gestion des Produits
- Création de produits : nom, quantité, prix.
- Base de données produits.
- Consultation, recherche, modification, suppression.

### 👨‍💼 Gestion des Caissiers
- Création de caissiers : nom, numéro de caisse.
- Base de données caissiers.
- Consultation, recherche, modification, suppression.

---

## 💡 Avantages & Points Forts

- 🔄 Architecture MVC claire.
- 🛠️ Utilisation de **Doctrine ORM** pour l'abstraction de la base de données.
- 🧩 Projet **modulaire**, simple à maintenir ou étendre.
- 📊 Interface back-office ergonomique pour une gestion simplifiée.
- 🔒 Possibilité d’ajouter une couche d’authentification ou rôles pour sécuriser.

---

## ⚙️ Pré-requis techniques

| Outil / Technologie | Version recommandée         |
|---------------------|-----------------------------|
| PHP                 | 8.1 ou supérieur             |
| Composer            | Dernière version             |
| Doctrine ORM        | Inclus via Composer          |
| Base de données     | MySQL / MariaDB              |
| Serveur local       | XAMPP, WAMP, Laragon, etc.   |
| Navigateur          | Chrome, Firefox, etc.        |

> 🔁 Possibilité d’utiliser PostgreSQL ou SQLite en adaptant la config Doctrine.

---

## 📁 Structure de Projet (principaux dossiers)

netticket/ ├── public/ # Point d’entrée (index.php) ├── src/ │ ├── Controller/ # Contrôleurs MVC │ ├── Entity/ # Entités (Doctrine) │ ├── Repository/ # Accès base de données ├── templates/ # Fichiers de vues (HTML / Twig) ├── config/ # Config Doctrine, routes... ├── .env # Variables d’environnement ├── composer.json # Dépendances PHP


---

## ❓ Questions Techniques

### Que contient le répertoire `templates/` ?
Le répertoire `templates/` contient les **fichiers de vues** (en général en **Twig**), utilisés pour afficher les interfaces utilisateur (formulaires, tableaux, pages HTML...).

### Que retourne `{{ app.asset() }}` ?
La fonction `{{ app.asset('chemin/vers/fichier') }}` dans Twig génère l’**URL absolue d’un fichier statique** (comme une image, un fichier CSS, JS, etc.) en fonction de la configuration du projet.  
Exemple :
```twig
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
🚀 Étapes pour exécuter le projet
Cloner le projet


git clone https://github.com/votre-utilisateur/netticket.git
cd netticket
Installer les dépendances avec Composer


composer install
Créer et configurer la base de données

Créez une base de données (ex: netticket_db) via phpMyAdmin ou terminal.

Mettez à jour la configuration dans .env :


DATABASE_URL="mysql://user:password@127.0.0.1:3306/netticket_db"
Créer les entités & générer la base avec Doctrine


php bin/console doctrine:schema:update --force
Lancer le serveur de développement


php -S localhost:8000 -t public
Accéder à l'application

Interface accessible via http://localhost:8000

🔒 Sécurité & Améliorations futures
Authentification des caissiers avec gestion de sessions.

Export PDF/Excel des tickets.

Graphiques de ventes mensuelles.

Responsive Design avec Bootstrap.

📧 Contact & Auteurs
Développé dans le cadre d’un projet académique.
Contact : choiyebsaad2000@gmail.com

Licence : chouaib saad
linkedin : https://www.linkedin.com/in/chouaib-saad-bb4106219/
