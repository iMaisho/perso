# HTML, CSS, JS
## Internet
### TCP/IP

IP = Internet Protocol
IP V4 : #.#.#.# avec 0 < # < 255, soit 8 bits par nombre, 32 bits au total, environ 4 milliard de valeurs possibles.
On va petit à petit vers IPv6 128 bits.

L'équivalent d'une adresse postale, chaque équipement a une adresse unique.

TCP = Transmission Control Protocol
Permet de garantir l'envoi des packets, en fournissant une "sequence number". Si on envoie 10 packets, chacun sera numéroté 1/10, 2/10, 3/10 etc... Si l'un d'entre eux est perdu en route, le destinataire peut demander un nouvel envoi.

Port Numbers : Donne à l'ordinateur l'indication du type de programme qui doit ouvrir les packets.

Par exemple, 80 pour HTTP ou 443 pour HTTPS

DNS = Domain Name Servers
Fais le lien entre un nom de domaine et l'adresse IP d'un site.

DHCP = Dynamic Host Configuration Protocol
Configure les IP et les DNS de nos appareils quand on les démarre, ce qui était autrefois configuré à la main.

HTTP = Hyper Text Transfer Protocol
HTTPS = Secured

### URLs

### Get & Post

Pour aller sur le site de Harvard, on va taper harvard.edu dans notre navigateur. Ce dernier enverra une requête au serveur sous cette forme :
```
GET / HTTP/2
Host : www.harvard.edu
...
```

Le serveur enverra cette réponse :

```
HTTP/2 200
Content-Type : text/html
...
```

200 est un status code qui signifique "OK", que tout s'est bien passé.

```
200 OK
301 Moved Permanently
302 Found
304 Not Modified
307 Temporary Redirect
401 Unauthorized
403 Forbidden
404 Not Found
418 I'm a Teapot
500 Internal Server Error
503 Service Unavailable
...
```

## HTML

HTML est un mark up langage, pas de fonctions, pas de loops etc.. Mais permet de présenter de l'information.

Ne pas faire confiance "client-side", car l'HTML peut être modifié grâce aux outils de dev des navigateurs.

validator.w3.org permet de vérifier que notre HTML est correct au niveau de la syntaxe.

