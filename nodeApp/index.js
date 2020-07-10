var mysql = require('mysql')
const express = require('express');
var connection = mysql.createConnection({
  // host: 'db_mysql.1.p2hp85hrpd6nly8e075s6ep3i',
  host: 'db_mysql',
  user: 'root',
  password: 'password',
  database: 'db',
})

connection.connect()

connection.query('SELECT 1 + 1 AS solution', function (err, rows, fields) {
  if (err) throw err

  console.log('The solution is: what ', rows[0].solution)
})

connection.end()

const PORT = 8080;
const HOST = '0.0.0.0';

// App
const app = express();
app.get('/', (req, res) => {
  res.send('Hello World aja nh');
});

app.listen(PORT, HOST);
console.log(`Running on http://${HOST}:${PORT}`);