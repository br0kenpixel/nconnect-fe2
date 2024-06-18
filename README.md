# nConnect CMS
Content/conference management system for nConnect Nitra.

## Requirements
- Apache/nginx for hosting the backend
- A MySQL database
- NodeJS or [Bun](https://github.com/oven-sh/bun) runtimes to serve the frontend

## Tested with
- Bun 1.1.12

# Functional Requirements

- [x] Aplikácia musí obsahovať prihlasovanie/registráciu administrátorov
- [x] Administrátor musí vedieť vykonávať CRUD operácie pre stage
- [x] Administrátor musí vedieť vykonávať CRUD operácie pre časové okná v existujúcich stagoch
- [x] Administrátor musí vedieť vykonávať CRUD operácie pre profily speakerov - obrázok/krátky popis/dlhý popis/linky na sociálne siete
- [x] Administrátor musí vedieť vykonávať CRUD operácie pre prednášky k jednotlivým speakrom - krátky popis/dlhý popis
- [x] Administrátor musí vedieť prideľovať prednášky do jednotlivých časových slotov
- [x] Administrátor musí vedieť vytvoriť sponzora
- [x] Administrátor musí mať možnosť vytvorenia galérie - kategorické rozdelenie na ročníky
- [x] Používateľ sa musí vedieť zaregistrovať na konferenciu 
- [x] Po registrácii je potrebné aby prišiel registračný email na predvolenú adresu ako aj na adresu používateľa
- [x] Používateľ sa musí vedieť odhlásiť s konferencie
- [ ] Administrátor musí vedieť kto sa na danú konferenciu zaregistroval
- [x] Používateľ pri prihlasovaní sa na konferenciu musí mať možnosť výberu s jednotlivých prednášok
    - [ ] Validácia časových okien (nedovoliť vybrať 2 prednášky v tom istom čase)
- [x] Administrátor musí mať možnosť nastavovať kapacitu jednotlivých prednášok - toto sa musí prejavovať aj pri registrácii
- [x] Administrátor musí vedieť vykonávať CRUD operácie nad sekciou Povedali o nás - foto, výrok
- [x] Administrátor musí vedieť za pomoci WYSIWYG editora vytvárať custom stránky - príklad Ochrana osobných údajov
- [x] Všetky obsahové sekcie ktoré administrátor vie vytvoriť musia byť prístupné pre používateľov