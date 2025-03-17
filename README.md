# Auto-oferta - rynek samochodowy!

**Auto-Oferta** to intuicyjna aplikacja internetowa, która ułatwia kupno i sprzedaż samochodów. Przeglądaj setki ogłoszeń, dodawaj własne oferty i kontaktuj się bezpośrednio z innymi użytkownikami. Strona zapewnia wygodne filtrowanie, szybkie wyszukiwanie i wiele więcej [funkcjonalności](#Funkcjonalności). Znajdź idealne auto lub sprzedaj swój pojazd w kilku prostych krokach! 🚗💨

## Spis treści

1. [Technologie](#Technologie)
2. [Instalacja](#Instalacja)
3. [Funkcjonalności](#Funkcjonalności)
4. [Widoki](#Widoki)
5. [Autor](#Autor)

## Technologie

-   **Laravel**  
    Framework PHP, który posłużył jako fundament projektu. Został wykorzystany do tworzenia backendu aplikacji, obsługi routingu, walidacji formularzy oraz interakcji z bazą danych.

-   **Tailwind**
    Nowoczesny framework CSS użyty do szybkiego i estetycznego projektowania interfejsu użytkownika. Dzięki niemu aplikacja jest responsywna i przyjazna dla użytkownika.

## Instalacja

Wymagania:

-   [Node.js](https://nodejs.org/en)
-   [Composer](https://getcomposer.org/)
-   [XAMPP](https://www.apachefriends.org/pl/index.html)

1. **Sklonuj repozytorium:**

    Do wybranego przez siebie miejsca.

    ```bash

    git clone https://github.com/Squashim/AutoOferta.git

    cd AutoOferta

    ```

2. **Zainstaluj zależności:**

    ```bash
    composer install
    ```

    ```bash
    npm install
    ```

3. **Skonfiguruj plik .env:**

    Skopiuj .env.exampe do .env

    ```bash
    cp .env.example .env
    ```

4. **Zaimportuj baze danych do XAMPP:**

    Otwórz phpMyAdmin i utwórz nową bazę danych o nazwie projekt_php

    ```bash
    php artisan migrate
    ```

5. **Wygeneruj klucz aplikacji:**
    ```bash
    php artisan key:generate
    ```
    Dodaj go w APP_KEY w .env
6. **Uruchom serwer lokalny:**
    ```bash
    php artisan serve
    ```
    Aplikacja będzie dostępna pod adresem: http://localhost:8000.

## Funkcjonalności

-   **Logowanie i rejestracja:** Założenie konta w celu wystawiania ofert sprzedaży, wystawiania ocen/komentarzy i chatowania z innymi użytkownikami.
-   **Zarządzanie ofertami:** Dodawanie, edytowanie i usuwanie ofert sprzedaży swoich aut.
-   **Ulubione oferty:** Przeglądanie dostępnych ofert i dodawanie ich do ulubionych.
-   **Wystawianie komentarzy i ocen:** Każdy użytkownik posiada profil, na którym znajdują się opinie od innych użytkowników.
-   **Filtrowanie i sortowanie ofert:** Ułatwia znalezienie wymarzonego pojazdu.

## Widoki

Strona jest w pełni responsywa, posiada także ciemny i jasny motyw.  
Strona Główna  
![Strona główna](/public/assets/strona_glowna.jpg)

Formularz dodawania oferty  
![Formularz dodawania oferty ](/public/assets/formularz.png)

Oferta
![Oferta](/public/assets/oferta.png)

Zarządzanie ogłoszeniami  
![Zarządzanie ogłoszeniami](/public/assets/twoje_ogloszenia.jpg)

Filtrowania i sortowanie
![Filtrowania i sortowanie](/public/assets/filtrowanie.jpg)

Komentarze i oceny  
![Komentarze i oceny](/public/assets/komentarze.jpg)

Wiadomości  
![Wiadomości](/public/assets/wiadomości.jpg)

## Autor

Konrad Piekarz

Kontakt: konrad.piekarz@gmail.com
