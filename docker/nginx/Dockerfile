FROM nginx:1.15-alpine

COPY nginx.conf /etc/nginx/conf.d/default.conf.tmpl

CMD envsubst '$PHP_FASTCGI_PASS' < /etc/nginx/conf.d/default.conf.tmpl > /etc/nginx/conf.d/default.conf && nginx -g 'daemon off;'