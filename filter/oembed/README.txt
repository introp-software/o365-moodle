Description:
This is a text filter for Moodle that converts urls from many different media sites into embeded content.
Embed code is retrieved from the original site so should work even if the site changes embed format.

Installation:
Download the source files. (zip file is available under download section)
Unzip the package
Copy the "oembed" folder to moodle/filter on the Moodle server.
Login as an admin on the Moodle site and install the filter.

To use:
By default the oembed filter is enabled for all content.  You can change this under Plugins > Filters.

This filter allows users to embed documents from various online sources to be embedded into Moodle content. The user only has to enter the URL to the document and the filter takes care of converting the URL into an embeddable IFRAME. 

When inserting a media link url into a discussion, create a hyperlink and insert the url as the target.
When the discussion is posted the url will be changed into the embed content.
N.B. if you enable the "Convert URLs into links and images" filter ahead of this then it is easier for users to embed media.

For more information about Embeding refer URL "https://github.com/introp-software/o365-moodle/blob/moodle-docs/local/o365docs/filter_oembed.md"
 
