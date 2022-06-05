<div id="top"></div>

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://babybook.keanovancuyck.be">
    <img src="public/img/logob.svg" alt="Logo" width="300">
  </a>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#user">User</a></li>
        <li><a href="#admin">Admin</a></li>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#author">Author</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project

[![Product Name Screen Shot][product-screenshot]](https://babybook.keanovancuyck.be)

### User

This application is made to make birth lists for babies. You can very easily make a birth list for your baby by using this application. You just need to register and then you will already get the option to create a birth list. Once created, you can add items to your birth list. The birth list also includes a link to your baby's invitation page. With this link, your friends and family can access your baby's birth list. They will then see the different items that are on the birth list. They can then add these to their shopping cart and make a payment. Once the payment is done, they get a success page and the parent gets an email with the reservation. The parents can then also view these reservations in the birth list under reservations of the baby. You can also download the birth list as a PDF. In this PDF you can see the items that have not yet been reserved.


### Admin

Of course, these articles have to come from somewhere and this is what the admin does. The admin can do two things:

* First, he can scrape different categories coming from three websites: babyplanet, bollebuik and child planet. This will give the admin an overview of the categories that are in them, each with a button to scrape articles.
* So secondly, he can scrape these categories and see the articles that were in the category. He can then see in the table what price is there and exactly where it came from with a URL to the article. This allows the parents to add these items to their personalized birth list.

<p align="right">(<a href="#top">back to top</a>)</p>



### Built With

This list includes the tools I used to create this application. I used:

* [Laravel](https://laravel.com)
* [Tailwind](https://tailwindcss.com/)
* [MySQL](https://www.mysql.com/)
* [Mollie](https://www.mollie.com/be)
* [Mail](https://laravel.com/docs/9.x/mail)
* [Clipboard](https://clipboardjs.com/)
* [Dompdf](https://github.com/dompdf/dompdf)

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Getting Started

This is an example of how you may give instructions on setting up your project locally.
To get a local copy up and running follow these simple example steps.

### Installation

1. Clone the repo
   ```sh
   git clone https://github.com/gdmgent-webdev2/werkstuk---geboortelijst-keanovc.git
   ```
2. Install NPM packages
   ```sh
   npm install

3. Install composer packages
    ```sh
    composer install
    ```

4. Fill in the .env file

5. Run the server
   ```sh
    php artisan serve
    ```

6. If you want to check the mollie local
    ```sh
     ./ngrok http http://127.0.0.1:8000
    ```


<p align="right">(<a href="#top">back to top</a>)</p>



<!-- LICENSE -->
## License

Distributed under the MIT License.

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- CONTACT -->
## Author

Keano Van Cuyck - [@keanovancuyck](https://www.linkedin.com/in/keano-van-cuyck-8696441bb/) - keanvanc@student.arteveldehs.be

Website Babybook: [babybook.keanovancuyck.be](https://babybook.keanovancuyck.be/dashboard)

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- MARKDOWN LINKS & IMAGES -->
[product-screenshot]: public/img/screenshot.png
