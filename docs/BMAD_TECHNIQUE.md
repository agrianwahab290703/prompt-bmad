# BMAD (Break My App Down) Technique

## 📖 Apa itu BMAD?

BMAD (Break My App Down) adalah teknik software architecture yang memecah aplikasi menjadi komponen-komponen kecil, modular, dan terstruktur dengan baik.

## 🎯 Prinsip Utama

### 1. Separation of Concerns
Setiap komponen memiliki tanggung jawab yang jelas dan terdefinisi dengan baik.

### 2. Modularity
Komponen dapat dikembangkan, ditest, dan di-maintain secara independen.

### 3. Reusability
Komponen dirancang untuk dapat digunakan kembali di berbagai konteks.

### 4. Maintainability
Struktur yang jelas memudahkan maintenance dan debugging.

## 🔍 Proses BMAD

### Step 1: Analisis Requirements
- Pahami kebutuhan bisnis
- Identifikasi fitur-fitur utama
- Tentukan teknologi yang akan digunakan

### Step 2: Decomposition
- Pecah aplikasi menjadi modul-modul
- Tentukan dependencies antar modul
- Identifikasi shared components

### Step 3: Structure Design
- Buat hierarki folder yang logis
- Tentukan naming conventions
- Design API contracts

### Step 4: Implementation Planning
- Tentukan urutan development
- Identifikasi potential bottlenecks
- Plan for testing strategy

## 📁 Contoh Struktur BMAD

### E-Commerce Application

```
ecommerce-app/
├── frontend/
│   ├── components/
│   │   ├── common/
│   │   │   ├── Button.jsx
│   │   │   ├── Input.jsx
│   │   │   └── Card.jsx
│   │   ├── auth/
│   │   │   ├── LoginForm.jsx
│   │   │   └── RegisterForm.jsx
│   │   └── product/
│   │       ├── ProductCard.jsx
│   │       ├── ProductList.jsx
│   │       └── ProductDetail.jsx
│   ├── pages/
│   │   ├── Home.jsx
│   │   ├── ProductPage.jsx
│   │   └── CheckoutPage.jsx
│   ├── services/
│   │   ├── api.js
│   │   ├── auth.js
│   │   └── product.js
│   └── utils/
│       ├── validation.js
│       └── format.js
├── backend/
│   ├── controllers/
│   │   ├── AuthController.js
│   │   ├── ProductController.js
│   │   └── OrderController.js
│   ├── models/
│   │   ├── User.js
│   │   ├── Product.js
│   │   └── Order.js
│   ├── routes/
│   │   ├── auth.js
│   │   ├── products.js
│   │   └── orders.js
│   ├── middleware/
│   │   ├── auth.js
│   │   └── validation.js
│   └── utils/
│       ├── db.js
│       └── logger.js
└── shared/
    ├── types/
    └── constants/
```

## 💡 Best Practices

### 1. Consistent Naming
```
✅ Good:
- UserController.js
- userService.js
- user.routes.js

❌ Bad:
- user_ctrl.js
- UserSrv.js
- routes-user.js
```

### 2. Single Responsibility
```javascript
// ✅ Good: Single purpose
class UserAuthService {
  login(credentials) { }
  logout() { }
  validateToken(token) { }
}

// ❌ Bad: Too many responsibilities
class UserService {
  login() { }
  getUserProfile() { }
  updateUserSettings() { }
  sendEmail() { }
  processPayment() { }
}
```

### 3. Clear Dependencies
```javascript
// ✅ Good: Explicit dependencies
import { AuthService } from './services/AuthService';
import { UserRepository } from './repositories/UserRepository';

class UserController {
  constructor(authService, userRepository) {
    this.authService = authService;
    this.userRepository = userRepository;
  }
}

// ❌ Bad: Hidden dependencies
class UserController {
  login() {
    // Global variable usage
    const result = globalAuth.login();
  }
}
```

### 4. Proper Abstraction Layers

```
Presentation Layer (Views/Controllers)
    ↓
Business Logic Layer (Services)
    ↓
Data Access Layer (Repositories)
    ↓
Database
```

## 🏗️ BMAD dengan AI

Generator BMAD ini menggunakan AI untuk:

1. **Analisis Requirements**: AI memahami kebutuhan dari natural language
2. **Architecture Design**: AI merancang struktur optimal
3. **Code Generation**: AI generate boilerplate code
4. **Best Practices**: AI menerapkan best practices secara otomatis

## 🎨 Contoh Prompt yang Baik

### ❌ Prompt Buruk
```
Buatkan aplikasi web
```

### ✅ Prompt Baik
```
Buatkan aplikasi Todo List dengan fitur:
- User authentication (JWT)
- CRUD operations untuk todos
- Categories dan tags
- Filtering dan sorting
- Real-time updates dengan WebSocket

Tech stack:
- Frontend: React + TypeScript + Tailwind CSS
- Backend: Node.js + Express
- Database: PostgreSQL
- Auth: JWT dengan refresh tokens

Struktur:
- Gunakan clean architecture
- Implement repository pattern
- Add validation middleware
- Include error handling
```

## 📊 Metrics Keberhasilan BMAD

### Code Organization
- ✅ Clear folder structure
- ✅ Consistent naming
- ✅ Proper separation of concerns

### Maintainability
- ✅ Easy to find files
- ✅ Easy to understand purpose
- ✅ Easy to modify/extend

### Scalability
- ✅ Can add new features without restructuring
- ✅ Can swap implementations easily
- ✅ Can test components independently

## 🔗 Resources

- [Clean Architecture](https://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html)
- [SOLID Principles](https://en.wikipedia.org/wiki/SOLID)
- [Design Patterns](https://refactoring.guru/design-patterns)
- [Microservices Architecture](https://microservices.io/)

## 🚀 Getting Started

1. Identifikasi fitur utama aplikasi
2. Buat high-level architecture diagram
3. Decompose ke modul-modul kecil
4. Define interfaces/contracts
5. Implement dan test secara incremental

---

**Remember**: The goal of BMAD is not perfection, but clarity and maintainability!
