# Hoteli
V tej datoteki bom predstavil spletno aplikacijo te [GitHub](https://github.com) strani.
<br><br>
Ta aplikacija omogoča vnašanje hotelov in prijavo na njih.<br>
### Kazalo:
[Prijava in registracija](#prijava-in-registracija)<br>
[Administrator](#administrator)<br>
[Uporabniki](#uporabniki)<br>
[Upravljanje hotelov](#upravljanje-hotelov)
[Slika baze](#slika-baze)
## Prijava in registracija
### 1. Registracija
V spletno aplikacijo se lahko prijaviš na dva načina:<br>
- preko navadne registracije na spletni strani (datoteke se nahajajo v /registracija)
- preko Google API (z svojim Google računom)
### 2. Prijava
Tako kot registracija, se lahko v to spletno aplikacijo prijavite na dva načina:<br>
- z navadno prijavo (nahaja se v /prijava)
- z Google API (ki shrani podatke, če si se že prijavil kdaj prej)

## Administrator
Administrator je v posebni tabeli in je ločen od ostalega dela podatkovne baze.<br>
Datoteke administratorske strani se nahajajo v /admin .
Funkcija administratorja je da upravlja s ponudniki hotelov.<br>
Ima pa možnost dveh funkcij:<br>
- Dodajanje ponudnikov (vpiše e-naslov in geslo)
- Brisanje ponudnikov (izbere iz seznama ponudnikov (ta funkcija izbriše tudi vse hotele tega ponudnika))

## Uporabniki
Vsi uporabniki, ko so prijavljeni, lahko spreminjajo uporabniško ime in sliko profila, in če niso prijavljeni preko Google API lahko spreminjajo tudi geslo.
### 1. Ponudniki
Ponudniki imajo tri funkcije:<br>
- Dodajanje hotelov
- Urejanje hotelov (le svojih)
- Brisanje hotelov (le svojih)
### 2. Navadni uporabniki
Navadni uporabniki so tisti, ki se registrirajo na normalen način, bodisi preko Google API ali preko /registracija .<br>
Nimajo nobenih posebnih možnosti razen:<br>
- Prijava na hotele, ki so na voljo

## Upravljanje hotelov
Pri upravljanu hotelov obstajajo tri funkcije:
- Dodajanje
- Urejanje
- Brisanje
<br>
Za dodajanje in urejanje je stvar podobna.<br>
Prikaže se nam obrazec, kjer imamo označene vse atribute, ki jih moramo vpisati, ko jih vpišemo/uredimo se to shrani v podatkovno bazo. Te funkcije pa se nahajajo v /iud . <br>

### Slika baze:

![SLIKA-BAZE](https://testing.aristovnik.com/hoteli/baza_model/baza-image.png)
