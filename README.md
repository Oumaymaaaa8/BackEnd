# Gestion des Locations pour Agence

## Description

Application de gestion des locations immobilières utilisant Laravel pour le backend et Vue.js pour le frontend. Elle permet de gérer les propriétés, les clients, les agents et les locations.

## Technologies Utilisées

- **Backend** : Laravel
- **Frontend** : Vue.js
- **Base de données** : MySQL (ou autre)

## Structure du Projet

### Backend (Laravel)

- **Modèles** : Location, Client, Propriete, Agent
- **Contrôleurs** : LocationController, ClientController, ProprieteController, AgentController
- **Routes API** : Définies dans `routes/api.php`

### Frontend (Vue.js)

- **Composants** : Composants Vue pour afficher les détails des propriétés, clients, etc.
- **Services** : Services pour interagir avec l'API Laravel

## Points Clés

- **Modèles de Données** : Relations entre les tables définies dans les modèles Laravel.
- **API** : Endpoints pour gérer les opérations CRUD disponibles pour les entités principales.
- **Frontend** : Composants Vue.js pour afficher et interagir avec les données.

## Démarrage

1. **Backend** :
   - Configurez l'environnement et exécutez les migrations.
   - Démarrez le serveur Laravel.

2. **Frontend** :
   - Installez les dépendances et démarrez le serveur Vue.js.


