---
title: Moovmoov
description: Multi-regional and multilingual backoffice and marketplace — product management with advanced SEO, automated Amazon scraping and static SSR site generation per region.
role: Full Stack Developer and technical architect — designed the complete architecture, developed the backoffice, site generation system and scraping microservices.
---

## Context

Multi-regional marketplace project enabling centralized product catalog management with automatic deployment of e-commerce sites per region, each with its own domain name and localized content. The project reached 90% completion before being paused due to client-side planning constraints.

## Key Features

- Multi-region: one site generated per region with its own domain name
- Multilingual: product content, categories and SEO managed per language and market
- Fully customizable SEO: per product, category, subcategory and type — with a multilingual, multi-region route (slug) generation system
- Advanced permission system with draft/approval workflow, configurable per product and region
- Custom CMS to manage page content and menus (free navigation between any pages)
- Automated Amazon product data scraping (prices, listings)
- Amazon review scraping with customizable adaptation
- Category system with dynamic filters (radio/checkbox), values and statuses

## Technical Highlights

- Laravel (API backend) + Nuxt 3 (backoffice) + Nuxt 3 SSR/SSG architecture for static marketplace site generation
- Dedicated Amazon scraping microservice (decoupled from the monolith)
- Multilingual, multi-region SEO slug system with customizable routes
- Publication workflow with granular statuses (draft, submitted, rejected, approved, published, archived)
- Backoffice UI with Element Plus and integrated multi-market/multi-language management
- Category, filter and value system with join tables and many-to-many relationships
