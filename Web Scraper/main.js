class Book{
   constructor(title, unitCost){
      this.title = title;
      this.unitCost = unitCost;
   }
}

function getPages(element){
   var pages = element.replace(/\s/g, "");
   pages = pages.substring(11, pages.length);
   return pages;
}

function compare(a, b) {
   const bookA = a.unitCost;
   const bookB = b.unitCost;
 
   let comparison = 0;
   if (bookA > bookB) {
     comparison = -1;
   }
   else if (bookA < bookB) {
     comparison = 1;
   }
   return comparison;
 }

 //Demonstration of results
function showSorted(books){
   console.log('SORT');
   books.sort(compare);

   console.log('lp. Title        Unit cost');
   for(var i = 0; i < books.length; i++){
      console.log(i + 1, books[i].title, books[i].unitCost);
   }

   var http = require('http');
   var fs = require('fs');

   var table = '<table><tr><th>lp</th><th>Tytuł</th><th>Koszt jednostkowy</th></tr>';

   function onRequest(request, response) {
      response.writeHead(200, {'Content-Type': 'text/html'});
      fs.readFile('./index.html', null, function(error, data) {
         if (error) {
               response.writeHead(404);
               response.write('File not found!');
         } else {
               response.write(data);

               for(var i = 0; i < books.length; i++){
                  table += '<tr>';
                  table += '<td>' + (i + 1).toString() + '</td>';
                  table += '<td>' + books[i].title + '</td>';
                  table += '<td>' + books[i].unitCost + 'zł </td>';
                  table += '</tr>';
                  console.log(i+1, books[i].title, books[i].unitCost);
               }
               
               table += '</table>';
               response.write(table);
               
         }
         response.end();
      });
   }


   http.createServer(onRequest).listen(8000);

}

//SCRAPING

const rp = require('request-promise');
const cheerio = require('cheerio');

var END = false;
var books = [];
var lp = 0;
var numOfBooks = 1600;


for(var page = 1; page <= 160; page++){
   rp({url: 'https://www.swiatksiazki.pl/Ksiazki/fantastyka-1767.html?p=' + page.toString(), simple: false})
      .then(function (html){
         const $ = cheerio.load(html);
         $('.product-item-link').each((i, el) => {
            var link = $(el).attr('href');
            if(link != null){
               rp(link)
                  .then(function(html2){
                     const $ = cheerio.load(html2);
                     var numOfPages = getPages($(".product-info-attributes li:contains('Ilość stron')").text());
                     var price = $('.special-price .price-wrapper').attr('data-price-amount');
                     var title = $('.page-title .base').text();
                     if(numOfPages != null) {
                        var unitCost = (price / numOfPages).toFixed(2);
                        var book = new Book(title, unitCost);
                        books.push(book);
                        console.log(lp + 1, book.title);
                     }
                     else{
                        console.log(lp + 1, 'Brak liczby stron');
                     }
                     lp++;
                     if(lp >= numOfBooks){
                        showSorted(books);
                     }
                  })
                  .catch(function(err){
                     lp++;
                     console.log(lp, 'nie udało się otworzyć informacji o książce')
                     if(lp >= numOfBooks){
                        showSorted(books);
                     }
                  }); 
            }
         });
      })
      .catch(function (err) {
         lp += 10;
         console.log(lp, 'nie udało się otworzyć strony');
         if(lp >= numOfBooks){
            showSorted(books);
         }
      });
}


