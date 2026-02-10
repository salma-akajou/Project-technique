---
marp: true
theme: default
_class: lead
paginate: true
backgroundColor: #ffffff
color: #5B2C6F
style: |
  img {
    max-width: 80%;
    max-height: 65vh;
    display: block;
    margin: 1em auto;
    object-fit: contain;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }
---

<!-- Page de garde -->
# Présentation Projet technique
### Application de gestion et filtrage des films
**Présentée par : Salma Akajou**  
**Encadré par : M. Fouad Essarraj**  
**Date : 05/01/2026**

---

<!-- Waterfall -->
# Plan : 
**- Méthode Waterfall**
**- Exigences: Travail à faire**
**- Contexte: Projet de fin de formation**
**- Analyse technique**
**- Analyse : Analyse fonctionnelle**
**- Conception**
**- Versions**
**- Versions (v1 - v8)**
**- Conclusion**

---

<!-- Waterfall -->
# Méthode Waterfall
![Waterfall](imgs/Waterfall.png)

---

## Exigences: Travail à faire

### Développement d'une application des films
*   **Partie Publique:** Interface permettant aux visiteurs de consulter les films. Fonctionnalités : Recherche par titre, directeur, filtre par catégorie, pagination (6 éléments/page).
*   **Partie Admin:** Tableau de bord sécurisé pour les opérations CRUD. Fonctionnalités : Modales pour ajout/édition, AJAX pour les mises à jour asynchrones.

---

<!-- Contexte -->
# Contexte : Projet de Fin de Formation
*   **Projet de Fin de Formation:** Travail sur le projet de fin de formation, commençant par la branche technique.
![2TUP](imgs/2_tup.png)

---

<!-- Analyse technique -->
# Analyse Technique

**Technologies à utiliser :**

1. **Base de données** : MySQL,
2. **Framework** : Laravel,
3. **Architecture n-tiers** : Services,
4. **Architecture** : MVC,
5. **Moteur de vues** : Blades,
6. **Ajax**,
7. **Alpine.js:** Librairie JavaScript pour les interactions dynamiques.
8. **Spatie:** Librairie pour la gestion des permissions et rôles.
9. **Upload images**,
10. **Laravel Multilangues**,
11. **Vite**,
12. **Preline UI library**
13. **Lucide Library**
14. **Css tailwind**

---

<!-- Fonctionnalités -->
# Analyse : Analyse fonctionnelle 
![diagram use case](imgs/diagram_use_cases.png)

---

<!-- Conception -->
# Conception
![diagram class](imgs/diagram_class.png)

---

## Versions (v1 - v8)

| Version | Description | Branche |
| :--- | :--- | :--- |
| **v1** | Public Side (Consultation, Recherche, Filtre) | `public` |
| **v2** | Admin Side (CRUD, Modales) | `admin` |
| **v3** | Authentification / Authorization (Gates) | `gates` |
| **v4** | SPA / AJAX | `spa-ajax` |
| **v5** | SPA / Alpine.js | `spa-alpine` |
| **v6** | Spatie / Authorization | `spatie` |
| **v7** | API | `api` |
| **v8** | Mobile App | `mobile` |

---

<!-- Sujet de Live coding -->
# Sujet de Live coding
## **v1 : Public Side**  
*  **Live Coding :** Creation du portfolio personnel

---

## **v2 : Admin Side**
* **Live Coding:** Gestion des articles (CRUD)

---

## **v3 : Authentification / Authorization** 
* **Live Coding :**

---

## **v4 : SPA / AJAX** 
* **Live Coding :** 
  - Bouton “Ajouter” via modale
  - Barre de recherche dynamique

---

## **v5 : SPA / Alpine.js**
* **Live Coding :** 
---

## **v6 : Spatie / Authorization**
* **Live Coding :**

---

## **v7 : API** 
* **Live Coding :** 

---

## **v8 : Mobile App**
* **Live Coding :** 

---

## Conclusion