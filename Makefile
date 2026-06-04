# --- VARIABLES ---
DC=docker compose
BACKEND_SVC=backend
FRONTEND_SVC=frontend
DB_SVC=postgres

# --- DOCKER CONTROL ---
.PHONY: up down restart build logs ps

up:
	$(DC) up -d

down:
	$(DC) down

restart:
	$(DC) restart

build:
	$(DC) up -d --build

logs:
	$(DC) logs -f

ps:
	$(DC) ps

# --- INITIALIZATION ---
.PHONY: init-backend init-frontend init

init-backend:
	$(DC) exec $(BACKEND_SVC) sh -c "rm -f public/index.php && composer create-project laravel/laravel /tmp/laravel && cp -a /tmp/laravel/. . && rm -rf /tmp/laravel"
	$(DC) exec $(BACKEND_SVC) php artisan key:generate
	$(DC) exec $(BACKEND_SVC) chmod -R 777 storage bootstrap/cache

init-frontend:
	$(DC) exec $(FRONTEND_SVC) sh -c "npm create vite@latest /tmp/frontend -- --template react-ts && cp -a /tmp/frontend/. . && rm -rf /tmp/frontend && npm install"

init: init-backend init-frontend

# --- SHELL ACCESS ---
.PHONY: shell-backend shell-frontend shell-db

shell-backend:
	$(DC) exec $(BACKEND_SVC) sh

shell-frontend:
	$(DC) exec $(FRONTEND_SVC) sh

shell-db:
	$(DC) exec $(DB_SVC) psql -U myuser -d transport_db

# --- CLEANUP ---
.PHONY: clean

clean:
	$(DC) down -v --rmi all --remove-orphans
