Installation instructions
=========================

```
git clone git@github.com:bugsduggan/bugs_cms.git
mkdir bugs_cms/templates_c
mkdir bugs_cms/cache
chmod 775 bugs_cms/templates_c
chmod 775 bugs_cms/cache
chown -R <you>:<webuser> bugs_cms
chmod 775 bugs_cms
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
