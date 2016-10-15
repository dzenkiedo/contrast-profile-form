block('profile-form')(
  tag()('form'),
  js()(true),
  attrs()({
    'method': 'post',
    'action': 'submit.php',
    'enctype': 'multipart/form-data'
  }));
