---
title: Moovmoov
description: Backoffice et marketplace multi-régional et multilingue — gestion de produits avec SEO avancé, scraping Amazon automatisé et génération de sites statiques SSR par région.
role: Développeur Full Stack et architecte technique — conception de l'architecture complète, développement du backoffice, du système de génération de sites et des microservices de scraping.
---

## Contexte

Projet de marketplace multi-régionale permettant de gérer un catalogue produit centralisé et de déployer automatiquement des sites e-commerce par région, chacun avec son propre nom de domaine et ses contenus localisés. Le projet a atteint 90% de complétion avant d'être suspendu pour des raisons de planning côté client.

## Fonctionnalités clés

- Multi-région : un site généré par région avec son propre nom de domaine
- Multilingue : contenus produits, catégories et SEO gérés par langue et par marché
- SEO entièrement customisable : par produit, catégorie, sous-catégorie et type — avec un système de génération de routes (slugs) multilingues et multi-régions
- Système de permissions avancé avec workflow draft/approbation, configurable par produit et par région
- CMS maison pour gérer le contenu de chaque page et menu (navigation libre entre pages)
- Scraping automatisé des données produit Amazon (prix, fiches)
- Scraping des avis Amazon avec personnalisation possible
- Système de catégories avec filtres dynamiques (radio/checkbox), valeurs et statuts

## Points techniques

- Architecture Laravel (API backend) + Nuxt 3 (backoffice) + Nuxt 3 SSR/SSG pour la génération des sites marketplace statiques
- Microservice dédié au scraping Amazon (découplé du monolithe)
- Système de slugs SEO multilingues et multi-régions avec routes customisables
- Workflow de publication avec statuts granulaires (draft, submitted, rejected, approved, published, archived)
- UI backoffice avec Element Plus et gestion multi-marché/multi-langue intégrée
- Système de catégories, filtres et valeurs avec tables de jointure et relations many-to-many
