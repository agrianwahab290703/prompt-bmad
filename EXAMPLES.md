# Contoh Penggunaan BMAD Generator

Dokumen ini berisi berbagai contoh prompt yang dapat digunakan untuk generate project structure dengan BMAD Generator.

## 📱 Mobile App Examples

### 1. To-Do List App

```
Buatkan aplikasi To-Do List mobile dengan fitur:
- User registration dan login
- Create, read, update, delete tasks
- Mark task sebagai complete/incomplete
- Kategorisasi tasks (Work, Personal, Shopping, etc)
- Set priority (High, Medium, Low)
- Due date untuk setiap task
- Search dan filter tasks
- Dark mode support

Tech Stack:
- React Native
- Redux untuk state management
- AsyncStorage untuk local storage
- React Navigation
- Styled Components

Struktur:
- Gunakan component-based architecture
- Implement custom hooks untuk reusable logic
- Add proper error handling
- Include unit tests
```

### 2. Weather App

```
Buatkan weather forecast app dengan:
- Current weather untuk lokasi user
- 7-day forecast
- Hourly forecast
- Multiple locations support
- Weather alerts
- Search cities
- Animated weather icons

Stack:
- Flutter/Dart
- OpenWeatherMap API
- BLoC pattern
- Shared Preferences
- Geolocator

Features:
- Clean Architecture
- Repository pattern
- Error handling
- Loading states
- Cache mechanism
```

## 🌐 Web Application Examples

### 3. E-Commerce Platform

```
Buatkan e-commerce platform dengan fitur:

Customer Features:
- Browse products dengan pagination
- Product detail dengan gambar gallery
- Add to cart
- Checkout process
- Order history
- User profile management
- Product reviews dan ratings
- Wishlist
- Search dan advanced filtering

Admin Features:
- Product management (CRUD)
- Order management
- User management
- Dashboard dengan analytics
- Inventory management
- Category management

Tech Stack:
- Frontend: Next.js + TypeScript + Tailwind CSS
- Backend: Node.js + Express + TypeScript
- Database: PostgreSQL
- Auth: JWT + Refresh Tokens
- Payment: Stripe integration
- Image Storage: AWS S3

Architecture:
- Clean Architecture
- Repository Pattern
- Service Layer
- Middleware untuk auth dan validation
- Error handling middleware
- API versioning
```

### 4. Blog Platform

```
Buatkan blogging platform seperti Medium dengan:

Features:
- Rich text editor (Markdown support)
- Draft dan publish posts
- Categories dan tags
- Comments system dengan threading
- Like dan bookmark posts
- Follow authors
- Reading list
- Search functionality
- SEO optimization

User Roles:
- Reader: dapat membaca, comment, like
- Author: dapat menulis posts
- Admin: full access

Stack:
- Frontend: Vue.js 3 + Composition API
- Backend: Laravel 10
- Database: MySQL
- Cache: Redis
- Search: Elasticsearch
- Storage: Cloudinary untuk images

Implementasi:
- RESTful API
- Slug generation untuk SEO
- Pagination
- Rate limiting
- Input validation
- XSS protection
```

## 🎮 Game Examples

### 5. Quiz Game

```
Buatkan multiplayer quiz game dengan:

Game Features:
- Real-time multiplayer (2-10 players)
- Multiple quiz categories
- Timed questions
- Scoring system
- Leaderboard (global dan friends)
- Power-ups
- Achievement system
- Daily challenges

Tech Features:
- WebSocket untuk real-time
- Progressive Web App (PWA)
- Offline mode support
- Sound effects
- Animations

Stack:
- Frontend: React + TypeScript
- Backend: Node.js + Socket.io
- Database: MongoDB
- Cache: Redis untuk leaderboard
- Hosting: Vercel + Railway

Architecture:
- Event-driven architecture
- State management dengan Redux Toolkit
- Service Workers untuk PWA
- Optimistic UI updates
```

## 🏢 Business Application Examples

### 6. Project Management Tool

```
Buatkan project management tool seperti Trello dengan:

Core Features:
- Boards, Lists, Cards (Kanban style)
- Drag and drop interface
- Task assignments
- Due dates dan reminders
- File attachments
- Comments dan mentions
- Activity log
- Labels dan custom fields

Team Features:
- Team workspace
- User roles dan permissions
- Team member invitation
- Notifications

Stack:
- Frontend: React + TypeScript + React Beautiful DnD
- Backend: Nest.js
- Database: PostgreSQL
- Real-time: Socket.io
- Storage: MinIO
- Email: SendGrid

Architecture:
- Microservices (Auth, Board, Notification)
- Event-driven
- CQRS pattern
- Docker containers
- Kubernetes deployment
```

### 7. CRM System

```
Buatkan Customer Relationship Management system dengan:

Modules:
- Contact Management
- Lead Management
- Sales Pipeline
- Task Management
- Email Integration
- Reporting dan Analytics
- Document Management

Features per Module:

Contact Management:
- CRUD contacts
- Import/Export CSV
- Contact history
- Tags dan segmentation

Lead Management:
- Lead capture forms
- Lead scoring
- Lead assignment
- Conversion tracking

Sales Pipeline:
- Deal stages
- Drag and drop
- Revenue forecasting
- Win/Loss analysis

Stack:
- Frontend: Angular 16 + Angular Material
- Backend: Spring Boot + Java 17
- Database: PostgreSQL
- Cache: Redis
- Search: Elasticsearch
- Reports: Jasper Reports

Implementation:
- Multi-tenancy support
- Role-based access control (RBAC)
- API rate limiting
- Audit logging
- Data encryption
```

## 🤖 AI/ML Application Examples

### 8. AI Chatbot Platform

```
Buatkan platform untuk build dan deploy chatbots dengan:

Features:
- Visual flow builder (drag and drop)
- NLP integration
- Multi-channel deployment (Web, WhatsApp, Telegram)
- Analytics dashboard
- Training data management
- Intent dan entity management
- Context management
- Fallback handling
- Live chat takeover

Technical:
- Frontend: React + React Flow
- Backend: FastAPI (Python)
- AI: OpenAI GPT / Custom NLP
- Database: PostgreSQL + Vector DB (Pinecone)
- Message Queue: RabbitMQ
- Cache: Redis

Architecture:
- Microservices
- Event-driven
- WebSocket untuk real-time
- REST API + GraphQL
- CI/CD pipeline
```

## 📊 Data Analytics Examples

### 9. Analytics Dashboard

```
Buatkan real-time analytics dashboard dengan:

Features:
- Multiple data source integration
- Custom dashboards
- Drag and drop widgets
- Chart types (line, bar, pie, scatter, heatmap)
- Real-time updates
- Data filtering dan drilling
- Export reports (PDF, Excel)
- Scheduled reports
- Alert system

Widgets:
- KPI cards
- Charts
- Tables
- Maps
- Gauges
- Timelines

Stack:
- Frontend: React + D3.js + Recharts
- Backend: Python + FastAPI
- Database: ClickHouse (time-series)
- Data Processing: Apache Kafka
- Cache: Redis
- Task Queue: Celery

Features:
- WebSocket untuk real-time data
- Data aggregation
- Query optimization
- Caching strategy
- Load balancing
```

## 🎓 Education Platform Examples

### 10. Online Learning Platform

```
Buatkan online learning platform (LMS) dengan:

Student Features:
- Browse courses
- Enroll in courses
- Video lessons
- Quizzes dan assignments
- Progress tracking
- Certificates
- Discussion forums
- Notes dan bookmarks

Instructor Features:
- Create courses
- Upload content (video, PDF, quiz)
- Grade assignments
- View analytics
- Interact dengan students

Admin Features:
- User management
- Course approval
- Platform analytics
- Payment management

Stack:
- Frontend: Next.js + TypeScript
- Backend: Node.js + Express
- Database: MongoDB
- Video: Vimeo API atau AWS S3 + CloudFront
- Payment: Stripe
- Email: AWS SES

Implementation:
- Video streaming optimization
- Progress tracking algorithm
- Certificate generation
- Recommendation engine
- Search dengan Algolia
```

## 💡 Tips untuk Prompt yang Baik

1. **Specific Features**: Sebutkan fitur-fitur yang jelas
2. **Tech Stack**: Tentukan teknologi yang ingin digunakan
3. **Architecture**: Sebutkan pattern atau architecture yang diinginkan
4. **Roles**: Jelaskan user roles jika ada
5. **Scale**: Jelaskan skala aplikasi (small, medium, enterprise)
6. **Integrations**: Sebutkan third-party services yang diperlukan
7. **Security**: Mention security requirements
8. **Performance**: Mention performance expectations

---

Gunakan contoh-contoh di atas sebagai inspirasi atau template untuk membuat prompt Anda sendiri!
