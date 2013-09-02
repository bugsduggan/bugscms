Installation instructions
=========================

```
git clone git@github.com:bugsduggan/bugscms.git
mkdir bugscms/templates_c
mkdir bugscms/cache
chmod 775 bugscms/templates_c
chmod 775 bugscms/cache
chown -R <you>:<webuser> bugscms
chmod 775 bugscms
```

You'll then want to navigate to the site. Your initial login will be 'admin' and 'password', you are strongly encouraged
to change it (there's a link on the right-hand site to edit your profile info).

This will then create the database file (`data.db` by default) in bugs_cms, you are encouraged to back up this file
regularly along with any changes you make to other files.

Customization
=============

Configuration options (such as the site name) are kept in `config/bugscms.conf`.

There are two files, `css/style.css` and `admin/css/style.css` which override the basic stylesheets for the public and
admin parts of the site respectively. There is also `admin/css/tinymce.css` which controls the style of the TinyMCE
controlled textareas.

Contributing
============

Contributions are always welcome, just fork this repo, make your changes and
issue a pull request.

Contributors are encouraged to join #bugscms on freenode.
