=== BuddyBoss Theme ===
Contributors: BuddyBoss
Requires at least: 4.9.1
Tested up to: 5.3.2
Version: 1.3.1
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

== Description ==

BuddyBoss Theme is a community theme for the BuddyBoss Platform.

== Installation ==

1. Visit 'Appearance > Themes'
2. Click 'Add New'
3. Upload the file 'buddyboss-theme.zip'
4. Upload the file 'buddyboss-theme-child.zip'

== Changelog ==

= 1.3.1 =
* Forums - Fixed 'New Discussion' button not working when widgets are added to Forums index
* Media - Fixed the positioning of emoji popup when loaded in mobile view
* Elementor - Fixed code outputting into Customizer when editing 'Elementor Full Width' pages
* LearnDash - Fixed Courses index always reverting to List view with BuddyBoss Platform disabled

= 1.3.0 =
* Groups - Updated the 'Send Invites' interface to be more intuitive (requires Platform update)
* Forums - Fixed issues when adding multiple forum shortcodes onto the same WordPress page
* Forums - Fixed @mentions typed into discussions/replies, need to auto-link to the member's profile
* Notices - Fixed 'Site Notices' link in profile dropdown, now redirects to Site Notices admin area
* BuddyPanel - Fixed currently selected sub-menu collapsing on each page refresh
* Beaver Builder - Added support for custom Header layouts with Beaver Themer
* Beaver Builder - Added support for custom Footer layouts with Beaver Themer
* LearnDash - New option to toggle display of 'Course Participants' on courses, lessons and topics
* LearnDash - Fixed performance issues with loading too many course participants at once
* LearnDash - Fixed radio buttons and checkboxes shrinking on Quizzes when text length is long
* LearnDash - Fixed issues with students not being able to view comments on Assignments
* LearnDash - Fixed courses count on Courses archive sometimes getting cached incorrectly
* LearnDash - Fixed wpDiscuz plugin comments not displaying on lessons and topics
* WooCommerce - Fixed display of widgets in mobile view, on WooCommerce shop page
* Compatibility - Fixed radio buttons not working correctly with MemberPress Stripe gateway
* Compatibility - Fixed radio buttons not working correctly with Gravity Forms Stripe Add-On
* Compatibility - Fixed extra checkbox showing next to 'Disabled' button with GDPR Cookie Consent
* Translations - Fixed text instances that could not be translated

= 1.2.9 =
* Messages - Improved the Messages dropdown loading experience
* Notifications - Improved the Notifications dropdown loading experience
* LearnDash - Added a temporary patch for the password reset bug in LearnDash v3.1.1

= 1.2.8 =
* Compatibility - Fixed errors with GamiPress and WP Job Manager

= 1.2.7 =
* Messages - Add dot indicator to unread messages, to make it more obvious which are unread
* Forums - Fixed issue with posting a forum reply consisting of just a GIF
* Elementor - Added support for custom Header templates in Elementor's Theme Builder
* Elementor - Added support for custom Footer templates in Elementor's Theme Builder
* Elementor - Fixed styling of WooCommerce 'Products' block for Elementor, in Internet Explorer 11
* LearnDash - Fixed Vimeo embeds on Topics having too much space above and below, in LearnDash 3.1
* LearnDash - Fixed styling of LearnDash login popup on courses when 'Anyone can register' is disabled
* LearnDash - Improved responsive styling of comments on Lessons and Topics
* WC Vendors - Added styling for all features in WC Vendors and WC Vendors Pro
* Licenses - Fixed issues with activating Lifetime 10 site licenses

= 1.2.6 =
* LearnDash - Added support for comments in 'Focus Mode' using new logic from LearnDash 3.1
* LearnDash - Fixed error on Courses index when website has only one member in LearnDash 3.1
* LearnDash - Fixed element scrolling issues with 'Matrix Sorting' question type in quizzes
* LearnDash - Fixed styling for 'Free Choice' question type in quizzes
* LearnDash - Fixed course 'Participants' list showing incorrect number of enrolled members
* Theme Options - Fixed styling for color picker buttons after WordPress 5.3.0 update
* Theme Options - Fixed color options not working for widgets added to Elementor pages
* Compatibility - Fixed checkbox fields not working correctly with WP Fluent Forms

= 1.2.5 =
* Menus - Fixed menu icon picker popup, conflict with WordPress 5.3.0

= 1.2.4 =
* Login - Fixed login screen styling after WordPress 5.3.0 update
* Login - Added styling for 'Administration email verification' screen in WordPress 5.3.0
* Notices - Improved responsive styling for site notices
* LearnDash - Fixed 'Course Materials' not appearing on course homepage
* Compatibility - Fixed checkbox fields not working correctly with Quforms, Bookly, and Elementor

= 1.2.3 =
* Groups - When logged out users visit a private group, now redirects to Login instead of 404 error
* Forums - Added full support for all bbPress forum shortcodes
* Forums - Added breadcrumbs on sub forums, showing link back to their parent forum
* Forums - Added support for 'Ctrl + Enter' keyboard shortcut to submit a discussion or reply
* Forums - Fixed double 'Private: Private:' text displaying in private standalone forum titles
* Messages - Fixed inconsistent naming scheme between messages dropdown and messages inbox
* Messages - Fixed the padding around names in inbox header when there are many recipients
* Messages - Fixed message icon disappearing from members list when translated to certain languages
* Notices - Add styling for displaying site notices on all WordPress pages
* Header - Added scrollbar into 'Profile Dropdown' menu when too many links are added
* Header - Fixed sub-menus getting duplicated when added into 'Profile Dropdown' menu
* Header - Fixed active icons in titlebar menu always showing in blue (requires re-save of options)
* Mobile - Fixed header link colors not applying in mobile header (requires re-save of options)
* Mobile - Added 'My Account' link next to avatar in mobile sidebar for easy account access
* Mobile - Fixed line-wrapping of long URLs when entered into 'Website' profile field type
* Mobile - Fixed activity link previews from getting cut off at the bottom
* Mobile - Improved support for small iPads, displaying mobile layout instead of desktop layout
* Widgets - Improved styling for the WordPress default search widget
* Widgets - Improved styling for the LearnDash 'User Status' widget
* Login Form - Fixed positioning of Email and Password icons
* Icons - Added new font icon 'Graduation Cap' which can be useful for LearnDash related menus
* Akismet - Improved styling for 'Spam' icon in activity feed when Akismet is configured
* Essential Addons for Elementor - Fixed CSS conflict with member profile navigation
* Events Calendar Pro - Fixed styling for checkboxes in the 'Show Filters' sidebar
* GamiPress - Fixed conflict between GamiPress and 'Delete Account' button in profiles
* LearnDash - Added styling for new 'My Courses' menu for logged in members
* LearnDash - Now displaying 'Dark Mode' icon in mobile header on lesson/topic/quiz pages
* LearnDash - Fixed 'Dark Mode' functionality when BuddyBoss Platform plugin is disabled
* LearnDash - Fixed 'View Course details' link not applying custom label for 'Course' text
* LearnDash - Fixed 'Back to Course' link not applying custom label for 'Course' text
* LearnDash - Fixed 'Last Activity' sometimes displaying incorrect date on courses
* LearnDash - Changed ribbon on quiz list shortcode to read 'Start Quiz' instead of 'Start Course'
* LearnDash - Changed ribbon on free unenrolled courses to read 'Free' instead of 'Not Enrolled'
* LearnDash - No longer displaying the course price for members who are enrolled in paid courses
* MemberPress - Improved styling for the MemberPress login page on restricted content
* WISDM Ratings, Reviews, & Feedback - Changed function used for outputting titles to fix conflicts
* WooCommerce - Fixed the outdated 'review-order.php' template after WooCommerce 3.8.0 update
* WooCommerce Memberships - Fixed layout of blog posts when they are given restricted access
* WPForms - Fixed search results conflict between WPForms and 'Network Search' component
* WP Job Manager - Fixed repeating icons for RSS and Reset after submitting a job search
* Compatibility - Fixed conditional form fields not working correctly in various form plugins
* Compatibility - Fixed checkbox fields not working correctly in various form plugins
* Compatibility - Improved support for modern versions of Internet Explorer
* Translations - Added Hungarian language files, credits to Tamas Prepost

= 1.2.2 =
* Header - Added options for multiple icons in mobile header
* Header - Added support for logos compressed with WebP image format
* Footer - Added new 'Social Links' for Dribbble, Email, Github, RSS, Skype, Vimeo, VK, XING
* Forums - Tags - Now displaying tags under the title of each discussion
* Forums - Tags - When adding tags to a discussion or reply, now showing suggested tags as you type
* Forums - When embedding a video into a reply, now displays the video preview instantly
* Forums - Now displaying forum titles on standalone forums and sub-forums
* Forums - Now displaying the Forum index page title, when 'Show Forum Banner' option is disabled
* Forums - Now displaying correct date updated, under title of each discussion
* LearnDash - Quizzes - Fixed small image sizes on drag and drop quizzes
* LearnDash - Quizzes - Fixed quiz progression when using 'All Questions required to complete'
* LearnDash - Quizzes - Highlight answered questions in green when using 'Quiz Summary'
* LearnDash - Quizzes - Highlight incorrect results in red
* LearnDash - Quizzes - Made the 'Choose a file' upload button more intuitive for Essay questions
* LearnDash - Fixed the 'Login & Registration' modal popup for Free courses
* LearnDash - Fixed the date published under the title on Lessons, Topics and Quizzes
* LearnDash - Fixed the Lessons archive page /lessons/ not being scrollable
* LearnDash - Fixed the date for 'Course Access Expiration' not using the WordPress date format
* LearnDash - Fixed the Lessons in sidebar opening and closing based on active lesson or topic
* Elementor - Fixed the layout output for 'Single Product' templates for WooCommerce
* MemberPress - Improved styling for 'Unauthorized' content login form
* Visual Composer - Improved styling for Visual Composer elements
* Messages - Now showing a different color for Read vs Unread messages, in Messages dropdown
* Templates - New template 'Full Width Content' similar to 'Fullscreen' but with Header and BuddyPanel
* Blog - In blog post comments, fixed link for commenter avatar
* RTL - Now displaying the custom login form design for sites set to RTL languages

= 1.2.1 =
* Elementor - Fixed BuddyPanel not appearing on 'Elementor Full Width' template
* Elementor - Fixed conflicts with Customizer
* LearnDash - Fixed 'Overall Score' not showing on Quizzes when enabled in 'Custom Results Display' settings
* LearnDash - Fixed expanding list of Topics on Closed course homepage to logged out users
* WooCommerce - Fixed expanding Stripe checkout when using 'WooCommerce Stripe Gateway' plugin

= 1.2.0 =
* Forums - Fixed 'Subscribe' button only appearing on forums that are connected to groups
* Notifications - Fixed issues with Bulk selection of all notifications
* Blog - Fixed post author and date published not displaying on posts in Blog archives
* WooCommerce - Fixed layout of Cart page when it is empty

= 1.1.9 =
* Activity - Improved styling for threaded activity replies on mobile
* BuddyPanel - When the second 'Header Style' was selected in Theme Options, 'BuddyPanel' options were missing
* WooCommerce - Updated outdated template files for latest version of WooCommerce
* WooCommerce - Fixed misaligned checkout fields when user 'Country' is in Europe
* BuddyPress User Blog - Improved styling for 'BuddyPress User Blog' plugin
* BuddyPress Docs - Fixed doc tabs not displaying correctly when using 'BuddyPress Docs' plugin

= 1.1.8 =
* Performance - Load 'Messages' and 'Notifications' dropdowns in header via AJAX, after page finishes loading
* Privacy - When search icon was disabled in theme options, it was still showing for pages excluded from Privacy
* Registration - Fixed alignment of the text 'or sign in' on register page
* LearnDash - Fixed the Maximize/Minimize button on Lessons and Topics remembering current state
* LearnDash - Fixed page flicker when moving between Lessons and Topics with 'Dark Mode' enabled
* LearnDash - When using 'LearnDash Course Grid' and paginating to next courses, fixed double Grid/List view icons
* LearnDash - When using 'Custom Question Ordering' with 'Randomize Order' option, the quiz layout was breaking
* Elementor - Fixed animated widgets not working in LearnDash Lessons and Topics
* Date Format - Fixed WordPress 'Date Format' setting not working in blog posts

= 1.1.7 =
* Profiles - In profile dropdown, long names were getting cut off
* Registration - With a lot of profile fields, the bottom of register screen was black
* Notifications - Automatically fetch new Notifications in header icons, without page refresh
* BuddyPanel - Fixed issues with sub-menus added to BuddyPanel
* Password Reset - Fixed incorrect message asking for 'At least 12 characters' in the password
* LearnDash - When viewing an 'Open' lesson while logged out, removed 'Login to Enroll' button
* LearnDash - Fixed low resolution profile photo on [ld_profile] shortcode
* LearnDash - Fixed issues with 'Matrix Sorting' question type in quizzes
* LearnDash - Fixed Vimeo videos getting tall dimensions with certain LearnDash settings
* LearnDash - Fixed incorrect number in Courses tab, when filtering courses by language with WPML plugin
* WooCommerce - Fixed issue with saving settings in WooCommerce 'My Account' area
* Translations - Fixed translation strings for LearnDash completion steps
* Safari - Fixed text getting cut off in Safari browser
* iPad - Fixed icons in header getting cut off on iPad browser
* Errors - Fixed various PHP errors in certain situations

= 1.1.6 =
* Profiles - In profile dropdown, the 'Privacy' menu was missing
* Profiles - In profile dropdown, menus added from plugins were missing
* Forums - Fixed PHP warning that sometimes displayed when replying with Media disabled
* Blog Posts - Use 'Social Networks' profile field data for social links in '(BB) Post Author' widget
* Post Types - Remove social share and related posts from custom post types
* LearnDash - Allow raw video file paths to be used in Course Preview Video
* LearnDash - On courses with video auto-progression, Mark Complete button was not always working
* LearnDash - Pagination on Courses index not always working
* LearnDash - Page content added above 'LearnDash Course Grid' was showing below the Grid/List toggle
* WooCommerce - Display shopping cart icon in header for logged out users
* Translations - Fixed Cyrillic letters displaying incorrectly on Login page
* Translations - Allow 'Topics' and 'Quizzes' translations to include multiple instances of plural for certain languages

= 1.1.5 =
* Activity - Fixed crop ratio for wide/landscape media images
* Activity - Fixed CSS conflict with emoji size from other plugins
* Members - Display consistent meta data on Members directory and Group Members pages
* Blog Posts - Fixed positioning of Social Share icons with BuddyPanel open
* Registration - Fixed registration text not always displaying properly
* LearnDash - Now using WordPress 'Date Format' for dates in LearnDash
* Mobile - Fixed many responsive layout issues
* Mobile - Display the Titlebar menus above the BuddyPanel menus in mobile panel

= 1.1.4 =
* Updater - Improvements to updater code for multisite

= 1.1.3 =
* Profiles - New option to add custom WordPress menu into 'Profile Dropdown'
* LearnDash - Allow LearnDash templates to be overridden in child theme
* BuddyPanel - Fixed alignment issues when image added as BuddyPanel icon
* Activity - Fixed formatting of comment box textarea
* Search - Fixed a conflict with search and mobile Safari
* Mobile - Fixed minor responsive layout issues
* Date Format - Now using WordPress 'Date Format' for dates throughout the network
* Licenses - Fixed issues with adding license key on multisite

= 1.1.2 =
* Profiles - Fixed profile dropdown not appearing with some plugins
* LearnDash - Fixed frontend conflicts with Elementor and other page builders
* LearnDash - Fixed header on Lessons and Topics when 'Sticky Header' is disabled
* LearnDash - Fixed pagination when 'Course Progression' is set to 'Free form'
* LearnDash - Fixed radio button styling in quiz questions on mobile
* LearnDash - Fixed 'Restart Quiz' button styling on mobile
* MemberPress - Improved styling for 'Account' area
* MemberPress - Improved styling for membership purchase
* Paid Memberships Pro - Added styling for frontend pages

= 1.1.1 =
* Elementor - Fixed scrolling in LearnDash lessons using Elementor
* Elementor - Fixed conflicts with Theme Builder templates
* Elementor - Fixed conflicts with Ultimate Addons for Elementor plugin

= 1.1.0 =
* Profiles - Fixed profile dropdown plugin conflict
* BuddyPanel - New option to 'stick' menu items to bottom of panel
* Media - Display single image in activity feed at native dimensions
* Mobile - Improved mobile styling for groups and courses indexes

= 1.0.9 =
* CartFlows - Fixed conflicts with CartFlows plugin

= 1.0.8 =
* Updater - Improvements to updater code

= 1.0.7 =
* LearnDash - Added support for comments in Lessons, Topics, and Quizzes
* LearnDash - Added support for [ld_course_list] shortcode with Course Grid add-on
* Elementor - Fixed CSS conflicts with Elementor Pro
* Elementor - Fixed template select preview panel in Elementor
* Elementor - Fixed 'Edit with Elementor' button in toolbar
* iMember360 - Fixed conflicts with iMember360 plugin
* Templates - Improved 'Fullscreen Page' template output
* Updater - Fixed issues with theme updater in multisite

= 1.0.6 =
* Search - Fixed a conflict with search and mobile Safari
* LearnDash - Fixed layout issue with header overlapping content

= 1.0.5 =
* LearnDash - Added support for 'Focus Mode Content Width'
* BuddyPanel - New option to set the default state as 'Open' or 'Closed'
* Updater - Fixed an issue with updater showing 'Package not found'

= 1.0.4 =
* LearnDash - Lesson/Topic videos from "Social Learner" content auto-migrate now
* LearnDash - Code cleanup (removed old templates)
* LearnDash - Fixed custom logo dimensions in Focus Mode
* LearnDash - Improved mobile styling
* Forums - Improved mobile styling
* Elementor - Fixed CSS conflicts with Elementor page builder
* Updater - Hide admin notices for invalid license if plugin or theme is inactive

= 1.0.3 =
* Forums - Fixed issues with replying twice in a row
* LearnDash - Fixed font family issue on [ld_profile] shortcode
* LearnDash - Display site logo when in Focus Mode
* LearnDash - Make the price box on courses float as you scroll
* LearnDash - New option to hide the course date published
* LearnDash - Use LearnDash default logic for displaying course currency
* LearnDash - Improved mobile styling on lessons and topics

= 1.0.2 =
* LearnDash - Fixed issue with Closed Course that has URL
* LearnDash - Use Course/Lesson customs labels
* Forums - Show excerpt in reply form
* Search Results - Styling improvements
* WP Job Manager - Styling improvements

= 1.0.1 =
* Forums - Nicer Tagging interface when replying
* LearnDash - Fixed issue with messaging the course 
* LearnDash - Dark Mode improvements
* Events Calendar Pro - Styling improvements
* WP Job Manager - Styling improvements

= 1.0.0 =
* Initial Release
* Supports BuddyBoss Platform
* Supports BadgeOS
* Supports Contact Form 7
* Supports Cornerstone
* Supports Elementor
* Supports Events Calendar Pro
* Supports GamiPress
* Supports Gravity Forms
* Supports Gutenberg
* Supports LearnDash
* Supports MemberPress
* Supports WooCommerce
* Supports WP Job Manager
