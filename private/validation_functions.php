<?php


   // isBlank('abcd')
  // * validate data presence
  // * uses trim() so empty spaces don't count
  // * uses === to avoid false positives
  // * better than empty() which considers "0" to be empty
  function isBlank($value) {
    return !isset($value) || trim($value) === '';
  }
  // hasPresence('abcd')
  // * validate data presence
  // * reverse of isBlank()
  // * more developer friendly name
  function hasPresence($value) {
    return !isBlank($value);
  }
  function isContainErrors($errorsArray)
  {
    return !empty($errorsArray);
  }
  




 ?>
