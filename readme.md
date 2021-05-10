# flatCore CMS Plugins

This repository contains a few useful plugins for the [flatCore Content Management System](https://github.com/flatCore/flatCore-CMS). All of these plugins are licensed under __GPL-3.0 License__ and can therefore be used absolutely freely. You are very welcome to take part in this project. I'm happy for every contribution.

* [ajaxform - a simple ajax form](#ajaxform)
* [bs-carousel - bootstrap carousel](#bs-carousel.php)
* [bs-modal - bootstrap modal](#bs-modal.php)
* [bs-tabs - bootstrap tabs](#bs-tabs.php)
* [captcha - a captcha for forms](#captcha)
* [downloader - download button for uploaded images](#downloader.php)
* [form - another simple form](#form.php)
* [imglinks - gallery from uploaded images](#imglinks.php)
* [video.js - embed uploaded videos](#video.js)
* [youtube - embed a youtube video](#youtube.php)


### ajaxform
This is a simple ajax contact form. This form will be sent to your E-Mail Adress from preferences (ACP - System - E-Mail). If you have SMTP Settings (content/config_smtp.php) it will use this automatically.
```[plugin=ajaxform][/plugin]```

### bs-carousel.php
Create Bootstrap Carousel. Filter uploaded images by keyword and order by priority.
```[plugin=bs-carousel.php]key=keyword[/plugin]```

### bs-modal.php
Create Bootstrap Modal. Get the contents (Text and Title) from a Snippet.
```[plugin=bs-modal.php]fcs=snippet[/plugin]```

### bs-tabs.php
Create Bootstrap Tabs. Get the contents (Text, Title and Permalink-Name) from Snippets.
```[plugin=bs-tabs.php]key=word[/plugin]```

### captcha
This Plugin is not ready to use. You can use this Captcha in your Forms. Include the file captcha_calc.php for Math-Based Captcha or captcha_img.php for Image-Based Captcha. An example will appear soon.

### downloader.php
This Plugin creates a simple Download Button. The download file must be in the /content/images/ directory.
```[plugin=downloader.php]f=filename[/plugin]```

### form.php
Just another contact form. The Requests are sent to the contact data stored in the settings.
```[plugin=form.php][/plugin]```

### imglinks.php
This Plugin generates a gallery from your Images. It find your uploaded images by the given keyword.
```[plugin=imglinks.php]key=keyword[/plugin]```

### video.js
Include a Video Player using video.js. You have to upload your Video in /content/files/ and a preview image in /content/images/.
```[plugin=video.js.php]v=myvideo[/plugin]```

### youtube.php
This plugin embeds a youtube video.
```[plugin=youtube.php]v=VIDEOID[/plugin]```