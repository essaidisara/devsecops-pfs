# Pipeline DevSecOps IA — Détection et Remédiation Automatique des Vulnérabilités

Projet d'ingénierie réalisé à l'**ENSA Marrakech** (filière Génie Cyberdéfense et Systèmes de Télécommunications Embarqués), module *Projet de Fin de Semestre*.

Pipeline DevSecOps complet qui détecte, priorise et corrige automatiquement les vulnérabilités applicatives grâce à l'intelligence artificielle, avec traçabilité complète via une approche GitOps.

**Encadré par :** M. Chanaa
**Réalisé par :** EL KISSANY Kaoutar · ELGADAOUI Chaimaa · ESSAIDI Sara
**Année universitaire :** 2025/2026

---

## Vue d'ensemble

Le projet répond à une problématique centrale : comment détecter, analyser et corriger les vulnérabilités applicatives en temps réel, tout en réduisant les faux positifs grâce à l'IA et en garantissant la reproductibilité via GitOps.

Le pipeline s'exécute de bout en bout sans intervention manuelle, depuis la récupération du code source jusqu'au déploiement de l'application corrigée sur Kubernetes.

## Architecture du pipeline


<img width="1024" height="572" alt="archi de pfs" src="https://github.com/user-attachments/assets/fe9ea684-9f38-448b-aa92-541d9e2c200e" />


**Application cible :** DVWA (Damn Vulnerable Web Application), volontairement vulnérable, pour valider la chaîne de bout en bout.

## Stack technique

| Couche | Outils |
|---|---|
| **Orchestration CI/CD** | Jenkins, Docker |
| **SAST** (analyse statique) | SonarQube |
| **DAST** (analyse dynamique) | OWASP ZAP |
| **SCA** (composants & images) | Trivy, OWASP Dependency-Check |
| **Moteur d'analyse IA** | Python, scoring EPSS + raisonnement LLM (Featherless / DeepSeek) |
| **Remédiation** | Ansible (playbooks) |
| **Déploiement** | Kubernetes, ArgoCD (GitOps) |

## Fonctionnement du moteur IA

1. **Agrégation** des rapports issus des 4 outils de scan hétérogènes (formats différents).
2. **Scoring hybride** combinant le score EPSS (probabilité d'exploitation) et un raisonnement contextuel par LLM.
3. **Filtrage des faux positifs** pour ne conserver que les vulnérabilités réellement exploitables.
4. **Génération automatique de patchs** pour les vulnérabilités les plus critiques (P1/P2).
5. **Application** des correctifs via des playbooks Ansible.
6. **Revalidation post-remédiation** avant tout déploiement.

## Résultats obtenus

| Étape | Volume |
|---|---|
| Alertes brutes collectées (4 outils) | 1 928 |
| Vulnérabilités uniques après déduplication | 318 |
| Faux positifs filtrés par l'IA | 66 |
| Vulnérabilités réelles retenues | 252 |
| Vulnérabilités ciblées pour patch (P1+P2) | 136 |
| Patches générés et validés automatiquement | 113 |

**Réduction du risque mesurée par revalidation :**

| Outil | Avant | Après | Réduction |
|---|---|---|---|
| Trivy — CVE HIGH/CRITICAL | 805 | 62 | **−92,3 %** |
| OWASP ZAP — Alertes | 8 | 8 | 0 % |

**Performance :** pipeline complet exécuté en **1h34**, sans intervention manuelle.

| Phase | Durée | Part du total |
|---|---|---|
| Build & Tests | ~2min 44s | 2,9 % |
| Scans de sécurité (SAST/DAST/SCA) | ~15min 23s | 16,4 % |
| Pipeline IA (scoring + patches) | 49min | 52,1 % |
| Remédiation Ansible | 22min | 23,4 % |
| Revalidation & Déploiement | ~2min 56s | 3,1 % |

## Valeur ajoutée de l'IA

Le moteur IA a diagnostiqué de manière autonome, pour 113 vulnérabilités sur 134 d'origine Trivy, que la cause racine commune était une image de base obsolète, recommandant son remplacement. Une estimation conservative situe l'équivalent manuel de cette analyse à environ **58,5 heures** de travail humain (15 min/CVE sur 234 CVE), réalisées ici de façon entièrement automatisée.

## Limites assumées

- La remédiation des vulnérabilités nécessitant une modification du cœur fonctionnel de l'application cible (fichiers protégés) reste hors du périmètre de l'automatisation complète.
- Projet académique réalisé sur une application volontairement vulnérable (DVWA) ; les résultats ne préjugent pas du comportement sur une application de production réelle.

## Installation

```bash
git clone https://github.com/essaidisara/devsecops-pfs.git
cd devsecops-pfs
```
<img width="505" height="416" alt="image" src="https://github.com/user-attachments/assets/2729f997-b547-4916-ad0f-10a010b603e7" />
<img width="533" height="392" alt="image" src="https://github.com/user-attachments/assets/b654ca5c-e96f-4971-8a6b-0bb15d524c96" />


<img width="825" height="394" alt="image" src="https://github.com/user-attachments/assets/af335be4-45f1-46cc-aa15-6572debe6212" />
<img width="855" height="414" alt="image" src="https://github.com/user-attachments/assets/998e2961-13bd-4015-93fb-6d6d4acb43dc" />
<img width="827" height="430" alt="image" src="https://github.com/user-attachments/assets/ce2dad37-22e9-40a9-946e-25d13aedb6fe" />




## Auteurs

- EL KISSANY Kaoutar
- ELGADAOUI Chaimaa
- ESSAIDI Sara

Encadré par M. Chanaa — ENSA Marrakech, filière GCDSTE — 2025/2026
