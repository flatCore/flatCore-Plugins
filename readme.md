# flatCore CMS Plugins

This repository contains a few useful plugins for the [flatCore Content Management System](https://github.com/flatCore/flatCore-CMS). All of these plugins are licensed under __GPL-3.0 License__ and can therefore be used absolutely freely. You are very welcome to take part in this project. I'm happy for every contribution.

* [ajaxform - a simple ajax form](#ajaxform)
* [bs-carousel - bootstrap carousel](#bs-carousel)
* [bs-modal - bootstrap modal](#bs-modal)
* [bs-tabs - bootstrap tabs](#bs-tabs)
* [captcha - a captcha for forms](#captcha)
* [downloader - download button for uploaded images](#downloader)
* [form - another simple form](#form)
* [imglinks - gallery from uploaded images](#imglinks)
* [posts - Show the most recent posts](#posts)
* [video.js - embed uploaded videos](#video)
* [youtube - embed a youtube video](#youtube)


### ajaxform
This is a simple ajax contact form. This form will be sent to your E-Mail Adress from preferences (ACP - System - E-Mail). If you have SMTP Settings (content/config_smtp.php) it will use this automatically.

```[plugin=ajaxform][/plugin]```

### bs-carousel
Create Bootstrap Carousel. Filter uploaded images by keyword and order by priority.

```[plugin=bs-carousel.php]key=keyword[/plugin]```

### bs-modal
Create Bootstrap Modal. Get the contents (Text and Title) from a Snippet.

```[plugin=bs-modal.php]fcs=snippet[/plugin]```

### bs-tabs
Create Bootstrap Tabs. Get the contents (Text, Title and Permalink-Name) from Snippets.

```[plugin=bs-tabs.php]key=word[/plugin]```

### captcha
This Plugin is not ready to use. You can use this Captcha in your Forms. Include the file captcha_calc.php for Math-Based Captcha or captcha_img.php for Image-Based Captcha. An example will appear soon. Includet font: [Ubuntu Mono](https://design.ubuntu.com/font/) distributed under an [open licence](http://www.ubuntu.com/legal/terms-and-policies/font-licence).

### downloader
This Plugin creates a simple Download Button. The download file must be in the /content/images/ directory.

```[plugin=downloader.php]f=filename[/plugin]```

### form
Just another contact form. The Requests are sent to the contact data stored in the settings.

```[plugin=form.php][/plugin]```

### imglinks
This Plugin generates a gallery from your Images. It find your uploaded images by the given keyword.

```[plugin=imglinks.php]key=keyword[/plugin]```

### posts
Show the most recent entries from fc_posts. You can filter the posts by type and limit the number of posts to show. *Note:* You should not mix post type event with other types. This would end up with unexpected results in the sorting.

Display 6 posts of type message, image and file

```[plugin=posts]type=m-i-f&limit=6[/plugin]```

Display the next three upcoming events

```[plugin=posts]type=e[/plugin]```

### video
Include a Video Player using video.js. You have to upload your Video in /content/files/ and a preview image in /content/images/.

```[plugin=video.js.php]v=myvideo[/plugin]```

### youtube
This plugin embeds a youtube video.

```[plugin=youtube.php]v=VIDEOID[/plugin]```