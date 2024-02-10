# Application Tracking System Project
This repository is used to house SDEV 305's (Web Development Frameworks) Team Cicada's Application Tracking System Project.


## By the end of class, the project will feature:
- The ability for a user to create a profile
- The ability for a user to quickly login
- View all applications
- A dashboard showing:
  - Things you need to follow up on
  - Jobs you tagged but haven't applied to yet
- Where you applied
- Opportunities

The client is Keller Flint-Blanchard.
Note: The department is planning on using this application to send jobs to students.


## How to get this project up and running on Mac if using VSCode
1. Clone this repository with `https://github.com/tien-han/applicationTrackingSystem.git` to get access to the code.
2. Download and install PHP
2a. If you have [Homebrew](https://brew.sh/) installed already, you can run `brew install php` (https://formulae.brew.sh/formula/php).
3. In the VSCode extensions tab, download and install "Live Server" and "PHP Server".
3a. Live Server launches your project into the browser and enables "live updating" each time you make a change, but only for front end files (JS, HTML, CSS).
3b. PHP Server launches the front end code and PHP backend so that your PHP can actually be run.

#### Note: For #4 & #5, these two extensions will use different ports when launched, so they don't really work "together". If you want them to work together, you also have to follow step #6.
4. If you are only working on front end code:
On any HTML page, click "Go Live" on the lower right corner to launch your front end (HTML/CSS/JS/etc). The browser will auto reload/refresh when you make code changes.
5. If you are working on front end or backend code:
On any HTML or PHP page, right click in the window and click "PHP Server: Serve Project" to launch your backend. You will have to refresh your browser since it doesn't update.

6. [Download Live Server Web Extension if Using Firefox](https://addons.mozilla.org/en-US/firefox/addon/live-server-web-extension/)


## How to get this project up and running on Windows
1. Clone this repository with `https://github.com/tien-han/applicationTrackingSystem.git` to get access to the code.
2. Install PHP: https://windows.php.net/

## Checklist of manual tests to make when adding a feature
#### General Testing for Each Feature:
- [ ] While testing in the browser, make sure the browser devtools/inspector is open. In the `console` tab, are there any errors?
- [ ] Are there enough comments in your added code so that another person can understand it at a glance? (Or yourself at a later date?)
- [ ] Is your filename self explanatory? Or is the purpose not clear?
- [ ] What does the page look like on a smaller screen? Is text wrap changing properly? Does anything look "broken"?
- [ ] If code was copied and pasted, are there any duplicated code sections/comments that need to be removed or updated?

#### Navbar Changes
- [ ] Click around to every page, and test every link on each page. Are there any broken links, or links that take you somewhere not expected?
- [ ] Check how it looks on smaller screens - does it collapse appropriately?
- [ ] Make sure that the navbar items are the same on each page, and that they don’t shift on hover/clicking.

#### Form Page:
- [ ] Does it have front end (top layer) validation? i.e. built in HTML browser validation.
- [ ] Does it have front end (middle layer) validation? i.e. Javascript validation.
- [ ] Does it have back end (lowest layer) validation? i.e. PHP form validation.
    - [ ] Is there validation on what type of information is being sent in?
    - [ ] Is there validation that we’re stripping leading & trailing white space, no “breaking” special characters, etc -> i.e. sanitizing inputs before saving into our database.?
- [ ] Does the form style match other forms?
- [ ] Does the form receipt page match the other form receipt pages?

#### Dashboard Page:
- [ ] Is there dummy data in the tables?