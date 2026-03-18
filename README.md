# FMS-FRMS-IBM (Integrated Budget Module)

## Overview
The **Financial Management Services - Financial Resource Management System - Integrated Budget Module (IBMS)** is a comprehensive institutional budget management system designed for **Central Luzon State University (CLSU)**. It automates the tracking, approval, and management of budget obligations (OBR/BUR), fund allocations, and real-time financial monitoring.

## 🚀 Quick Start

### 1. Backend Setup (Laravel)
```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
# Configure your DB (SQLite by default)
php artisan migrate:fresh --seed
php artisan serve
```

### 2. Frontend Setup (React + Vite)
```bash
cd frontend
npm install
npm run dev
```

## 🌐 Accessing the App
Once both servers are running:
- **Frontend URL**: [http://localhost:5173](http://localhost:5173)
- **API Base URL**: `http://localhost:8000/api`

## 👤 Demo Accounts (Seed Data)
The system is pre-loaded with demo accounts for evaluation.
**Default Password for all demo users**: `CLSU-FRMS-2026!`

| Role | Username | Office |
|------|----------|--------|
| FMS Director | `director` | FMS |
| IT Admin | `it_admin` | IT |
| MISO Requestor | `miso_requestor` | MISO |
| Budget Head | `budget_head` | Budget |
| Cashier | `cashier` | Cashier |


## 🔐 Role-Based Access Control (RBAC)
The system features a strict role-based access matrix:
- **Director**: Full overview and override capacity.
- **Budget Head**: High-level budget oversight and review.
- **Budget Clerk**: Data entry and OBR/BUR processing.
- **Cashier**: Income collections and OR oversight.
- **Requesting Office (MISO, CoEd, etc.)**: Isolated view of their own department's requests only.
- **IT Admin**: User management, role assignment, and fund access control.

## 🏛️ Institutional Branding
All official CLSU branding assets (Seal, Logos, Watermarks) are located in `frontend/public/assets/branding`. Fidelity to these assets is mandatory as per institutional standards.

---

# 🤖 AGENT_README - FMS-FRMS-IBM

## 🎯 Context for AI Agents
You are working on the **FMS-FRMS-IBM** project. This is a robust management system for university finances.

### 🏗️ Architecture Patterns
- **Backend**: Laravel 11. Custom math logic for **Box B** (point-of-deduction) is located in `app/Models/ObligationRequest.php`.
- **Frontend**: React + TypeScript. Role-based gating is centralized in `src/utils/rbac.ts` and enforced via `<RoleGuard>` in `App.tsx`.
- **Math Logic**: Budget math must NEVER be done on the client side only; verify all totals against the database balances (`PpmpBalance` model).

### 🛠️ Key Directories
- `frontend/src/features/`: Component-based features (obligations, audit, admin, etc.)
- `backend/app/Models/`: Core entity logic and relationships.
- `backend/database/seeders/`: Demo accounts and pilot fund clusters (Fund 163).

### 📐 Coding Standards
1. **Styling**: Use Vanilla CSS for custom components. Institutional green (`#005230`) and gold (`#F8B41D`) are the primary brand anchors.
2. **Icons**: Use `lucide-react`.
3. **RBAC**: When adding new pages, register them in `rbac.ts` and set appropriate permissions in the `ACCESS_MATRIX`.
4. **State**: Zustand is used for authentication (`authSlice.ts`).

### 🧪 Verification
- Run `npx tsc --noEmit` locally in `frontend` before pushing UI changes.
- Ensure `php artisan migrate:fresh --seed` works without errors for fresh environment setup.

---
*Priority: Zero-tolerance for institutional logo distortion.*
