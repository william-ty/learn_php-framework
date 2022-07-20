SHELL := /bin/bash
include ./docker/.env

#Commandes spécifique
up: ## Construire et démarrer les conteneurs (peut être long)
	@sudo chmod 775 . -R;\
    $(MAKE) vhost --no-print-directory; \
	$(MAKE) host --no-print-directory; \
	docker-compose -f docker/docker-compose.yml build --build-arg WWWUSER=${USER}; \
	docker-compose -f docker/docker-compose.yml up -d; \

vhost: ## Crée le vhost apache et l entrée dans le fichier host de windows
	@cp docker/config/vhost.exemple docker/config/vhost.conf; \
	sed -i 's/%DIR%/${COMPOSE_PROJECT_VHOSTDIR}/g' docker/config/vhost.conf; \
	sed -i 's/%HOST%/${COMPOSE_PROJECT_HOST}/g' docker/config/vhost.conf;\
	echo "Vhost created"

host: ## Crée le vhost apache et l entrée dans le fichier host de windows
	@sed -i '/127.0.0.1 ${COMPOSE_PROJECT_HOST}/d' /mnt/c/Windows/System32/drivers/etc/hosts;\
	echo "127.0.0.1 ${COMPOSE_PROJECT_HOST}" >> /mnt/c/Windows/System32/drivers/etc/hosts;\
	echo "Host created"

host-clean:	## Supprime l entrée dans le fichier host de windows et le vhost apache
	@sed -i '/127.0.0.1 ${COMPOSE_PROJECT_HOST}/d' /mnt/c/Windows/System32/drivers/etc/hosts;\
	echo "Host clean"

errors: ## Affiche les log d'erreurs d'apache
	@docker-compose -f docker/docker-compose.yml exec $(COMPOSE_SERVICE_NAME) tail -f /var/log/apache2/vhost-error.log

access: ## Affiche les log d'accès d'apache
	@docker-compose -f docker/docker-compose.yml exec $(COMPOSE_SERVICE_NAME) tail -f /var/log/apache2/vhost-access.log

#Commandes générales
down: ## Arrête les conteneurs et supprime les conteneurs, les réseaux, les volumes et les images
	@docker-compose -f docker/docker-compose.yml down

start: ## Lance les services
	@docker-compose -f docker/docker-compose.yml start;

stop: ## Arrêter les services
	@docker-compose  -f docker/docker-compose.yml stop

status: ## Afficher tous les conteneurs
	@docker ps --all

logs: ## Affiche les logs des services
	@docker-compose  -f docker/docker-compose.yml logs --tail=100

bash: ## Lance un prompte bash dans le conteneur
	@docker-compose  -f docker/docker-compose.yml exec -u ${USER} -w "${COMPOSE_PROJECT_PATH}" $(COMPOSE_SERVICE_NAME) /bin/bash

help: ## Affiche la liste des commandes disponibles
	@IFS=$$'\n' ; \
    help_lines=(`fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##/:/'`); \
    printf "%-30s %s\n" "target" "help" ; \
    printf "%-30s %s\n" "------" "----" ; \
    for help_line in $${help_lines[@]}; do \
        IFS=$$':' ; \
        help_split=($$help_line) ; \
        help_command=`echo $${help_split[0]} | sed -e 's/^ *//' -e 's/ *$$//'` ; \
        help_info=`echo $${help_split[2]} | sed -e 's/^ *//' -e 's/ *$$//'` ; \
        printf '\033[36m'; \
        printf "%-30s %s" $$help_command ; \
        printf '\033[0m'; \
        printf "%s\n" $$help_info; \
    done