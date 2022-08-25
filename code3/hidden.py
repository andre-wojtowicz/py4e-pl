# Przechowuj ten plik oddzielnie

# 1. Zaloguj się lub załóż konto na https://twitter.com
# 2. Wejdź na stronę https://developer.twitter.com/en/apps
#    i spróbuj utworzyć nową aplikację ("Create an app"):
#    a) zostaniesz poproszony o założenie konta deweloperskiego
#       (Please apply for a Twitter developer account);
#    b) kliknij na "Apply"
#    c) wybierz "Hobbyist" > "Exploring the API" i wybierz "Next"
#    d) uzupełnij formularz (może być wymagana weryfikacja 
#       numeru telefonu)
#    e) w kolejnym kroku opisz po angielsku, jak zamierzasz 
#       wykorzystać dane Twittera (wspomnij, że uczysz się 
#       Pythona, chcesz dowiedzieć się, jak korzystać z API 
#       Twittera, zamierzasz napisać dwa mini-projekty, które 
#       w interaktywny sposób pobierają nazwę konta Twittera 
#       i dla podanego konta w projekcie nr 1 pobierzesz i 
#       wyświetlisz oś czasu użytkownika zwróconą w formacie
#       JSON, a w projekcie nr 2 pobierzesz listę jego znajomych
#       w formacie JSON i przeparsujesz ją w celu wyciągnięcia 
#       informacji o znajomych; opisz tę sekcję dość szczegółowo, 
#       gdyż wpływa ona na akceptację Twojego zgłoszenia); 
#       w sekcji "Specifics" zaznacz wszystko na "No"
#    f) zweryfikuj zgłoszenie, przeczytaj warunki umowy
#       i wyślij zgłoszenie
#    g) potwierdź zgłoszenie, klikając na link w wiadomości
#       mailowej, którą otrzymasz po wysłaniu zgłoszenia
# 3. Gdy Twoje zgłoszenie zostanie zaakceptowane, wejdź jeszcze
#    raz na https://developer.twitter.com/en/apps i ponownie
#    spróbuj utworzyć nową aplikację ("Standalone Apps" > 
#    "Create App")
# 4. Utwórz aplikację, w karcie "Keys and tokens" wygeneruj
#    klucze  i podmień poniższe cztery ciągi znaków dotyczące
#    consumer_key, consumer_secret, token_key i token_secret 
#    (podmień wszystko, co znajduje się między cudzysłowami, 
#    łącznie z nawiasami ostrokątnymi)

def oauth():
    return {# Consumer Keys
            "consumer_key":    "<tutaj umieść API key>",
            "consumer_secret": "<tutaj umieść API key secret>",
            # Authentication Tokens - Access Token & Secret
            "token_key":       "<tutaj umieść Access token>",
            "token_secret":    "<tutaj umieść Access token secret>"}
