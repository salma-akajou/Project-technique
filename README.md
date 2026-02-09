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
# Waterfall
![Waterfall](imgs/Waterfall.png)

---

<!-- Choix du sujet -->
# Choix du sujet
**gestion des films**

---


<!-- Contexte -->
# Contexte
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
7. **Upload images**,
8. **Laravel Multilangue**s,
9. **Vite**,
10. **Preline UI library**
11. **Lucide Library**
12. **Css tailwind**

---

<!-- Fonctionnalités -->
# Fonctionnalités 
![diagram use case](imgs/diagram_use_cases.png)

---

<!-- Conception -->
# Conception
![diagram class](imgs/diagram_class.png)

---

## Versions

### Version 1

- Public Side
- Branch : public

### Version 2

- Admin Side
- Branch : admin

### Version 3

- Authontification / Authorization (Gates)
- Branch : gates

### Version 4

- SPA (Single Page Application) / AJAX - Alpine.js
- Branch : spa

### Version 5

- Spatie / Authorization
- Branch : spatie

### Version 6

- API
- Branch : api

### Version 7

- Mobile App
- Branch : mobile

---

<!-- Sujet de Live coding -->
# Sujet de Live coding
- Un bouton “Ajouter” qui ouvre une modale pour créer un nouvel élément.
- Une barre de recherche filtrant des éléments par titre.
