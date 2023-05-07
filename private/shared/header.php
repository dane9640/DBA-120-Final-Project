<?php
  if(!isset($pageTitle)) { 
    $pageTitle = ' ';//Default page title 
  }
?>

<!doctype html>

<html lang="en">
  <head>
    <title><?php echo h($pageTitle); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo urlFor('stylesheets/styles.css'); ?>">
  </head>

  <body>
    <header>
      <h1><a href="<?php echo urlFor('/'); ?>">Lunsford County Public Library Management System</a></h1>
    </header>
    <nav>
      <ul>
      <!-- Navigation Links -->
      <li><a href="<?php echo urlFor('books/'); ?>">Books</a></li>
      <li><a href="<?php echo urlFor('genres/'); ?>">Genres</a></li>
      <li><a href="<?php echo urlFor('authors/'); ?>">Authors</a></li>
      <li><a href="<?php echo urlFor('members/'); ?>">Members</a></li>
      <li><a href="<?php echo urlFor('loans/'); ?>">Loans</a></li>
      </ul>
    </nav>
