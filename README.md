# Install

* Download symfony cli https://symfony.com/download
* Clone the repository
* Install all dependencies by running `composer install` v2
* Install all front dependencies by running `yarn install` v1.22
* Build the front assets by running `npm run dev` v8.5
* Run migrations `symfony console doctrine:migrations:migrate`
* Load fixtures `symfony console doctrine:fixtures:load`
* Run the app locally with `symfony serve`

# Tasks:

1. Correct all of the deficiencies in index.html
2. "Sectors" selectbox:
    1. Add all the entries from the "Sectors" selectbox to database
    2. Compose the "Sectors" selectbox using data from database
3. Perform the following activities after the "Save" button has been pressed: 
   1. Validate all input data (all fields are mandatory)
   2. Store all input data to the database (Name, Sectors, Agree to terms)
   3. Refill the form using stored data 
   4. Allow the user to edit his/her own data during the session

Scripts used to form data is located at /scripts