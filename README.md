# Papp Zoltan Portfolio

Ez a repository a sajat portfolio oldalamat tartalmazza, Laravel 12 alapokon ujraepitve. A cel nem egy tulbonyolitott bemutatkozo oldal volt, hanem egy olyan gyors, atlathato es konnyen deployolhato webes projekt, ami egyszerre mutatja meg a szakmai iranyomat es stabil alapot ad a tovabbi boviteshez.

Fejlesztoknek nezve ez a projekt leginkabb arrol szol, hogyan szeretek rendszert epiteni: egyszeru route-ok, tiszta controller reteg, config-alapu tartalomkezeles, minimalis mozgo alkatresz, es olyan szerkezet, amit kesobb is kenyelmes karbantartani.

## Rolam es a projekt iranyarol

Papp Zoltankent elsosorban olyan webes megoldasokon dolgozom, ahol a fejlesztes nem csak egy szep feluletet jelent, hanem valodi uzleti hasznot is. A portfolio ezt a szemleletet koveti: webfejlesztes, automatizalas, AI-tamogatott gondolkodas es gyakorlati technikai hatter egy helyen.

Az oldal ket nyelven kommunikal, szemelyesebb hangvetelu tartalommal, es kifejezetten arra van optimalizalva, hogy gyorsan atadja:

- mivel foglalkozom
- milyen technologiakban gondolkodom
- milyen tipusu projekteken dolgozom
- hogyan lehet velem kapcsolatba lepni

## Tech Stack

- Backend: PHP 8.2 + Laravel 12
- Frontend: Blade templating, egyedi CSS, vanilla JavaScript
- Tartalomkezeles: `config/portfolio.php` alapu ketnyelvu strukturalt adatok
- Mail: Laravel Mail SMTP kapcsolattal, env konfiguracioval
- Statisztika: egyszeru fajlalapu latogatoi szamlalas
- Deploy szemlelet: szerverre masolhato, klasszikus shared hosting / XAMPP kompatibilis felepites

Nem egy SPA vagy API-first projekt, hanem tudatosan egy konnyu, gyorsan kiszolgalhato Laravel oldal. Ez a valasztas itt praktikusabb volt, mint egy nehezebb frontend stack.

## Fo technikai iranyok

### 1. Egyszeru, olvashato Laravel szerkezet

A route-ok minimalisak, a logika controllerbe es service-be van szervezve, a tartalom pedig nem szetosztva el sok kulon adatforrasba, hanem kozpontilag kezelve.

- `routes/web.php`: publikus oldalak es kapcsolatfelvetel
- `app/Http/Controllers/PortfolioController.php`: oldaladatok, locale, SEO/schema adatok
- `app/Http/Controllers/ContactController.php`: validacio es levelezes
- `app/Services/VisitorCounter.php`: napi egyedi latogatoi meres
- `config/portfolio.php`: a portfolio tartalmi gerince

### 2. Config-alapu tartalom

A portfolio szoveges es strukturalt tartalma elsodlegesen konfiguraciobol jon, nem adatbazisbol. Ez gyorsabb deployt, kevesebb uzemeltetesi terhet es egyszerubb szerkesztest ad egy ilyen tipusu oldalnal.

Ez kulonosen hasznos ott, ahol:

- ritkan valtozik a tartalom
- fontos a ketnyelvu konzisztencia
- nincs szukseg kulon admin feluletre

### 3. Ketsegu helyett stabilitas

A projekt nem akar tobbet mutatni annal, mint ami valoban kell neki. Nincs felesleges absztrakcio, nincs tuleroltetett JS framework, nincs indokolatlan adatbazis-fugges a tartalmi retegnel. A fo prioritas itt a sebesseg, az ertheto kod es a konnyu szerveres telepites.

## Deploy Ready allapot

A projekt ugy van szervezve, hogy egyszeruen fel lehessen masolni szerverre. A jelenlegi allapot alapjan a deployment szempontjabol a lenyeges pontok:

- a levelezes env alapu, nincs hardcode-olt mail config PHP fajlban
- kulon kezelheto a lokalis `.env_dev` es az eles `.env`
- a gyokerben van `.htaccess`, ami segit a Laravel `public` mappas kiszolgalashoz
- a publikus assetek jelenleg a `public` mappaban vannak, igy nem fugg a projekt egy kulon build pipeline futasatol a sima kiszolgalashoz
- a kapcsolatfelveteli funkcio SMTP-vel mukodik, Titan mail beallitasokra elokeszitve

Ha ezt a projektet szerverre masolod fel, akkor a gyakorlatban egy klasszikus, gyorsan uzembe allithato Laravel portfolio alkalmazast kapsz, nem egy tulkomplikalt release folyamatot.

## Fejlesztoi megjegyzesek

Ez a repository jo alap lehet akkor is, ha valaki hasonlo szemelyes oldalt vagy szolgaltatas-bemutato microsite-ot akar epiteni Laravelben. A fo ujrahasznalhato mintak:

- ketnyelvu config-alapu tartalommodell
- egyszeru contact flow Laravel Maillel
- SEO/schema fokuszu page data epitese controller oldalon
- kis overheadu, fajlalapu statisztika

Ha tovabb fejlodik a projekt, a leglogikusabb iranyok:

- admin felulet vagy CMS integracio
- projektek kulon adatforrasba emelese
- reszletesebb analytics
- tovabbi landing oldalak vagy szolgaltatas-specifikus oldalak

## Osszkep

Ez a portfolio nem csak bemutatkozo oldal, hanem egy rovid technikai lenyomat arrol is, hogyan gondolkodom fejlesztokent: uzleti celra epito webes rendszerek, egyszeru de igenyes megvalositas, es olyan stack valasztas, ami nem csak modernnek akar latszani, hanem hosszu tavon is praktikus.
