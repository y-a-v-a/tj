Deployment
==========

Paths
-----

    apps/
      god-is-a-tj/
        public/                  docroot for god-is-a-tj.com
          index.php              site config -> ../../../shared/template.php
          getline.php            reads ../../../data/bible.txt, strips the
                                 Project Gutenberg header/footer, samples via
                                 shared TextJockey
          js -> ../../../shared/js   (symlink)
          llms.txt  robots.txt  favicon.ico  .htaccess
      neuropolis-n/
        public/                  docroot for neuropolisn.com
          index.php              site config -> ../../../shared/template.php
          getline.php            sleeps 2s, picks a random cache/*.txt,
                                 samples via shared TextJockey
          cache/                 scraped source texts (*.txt) — NOT in git,
                                 must exist on the server
          js -> ../../../shared/js   (symlink)
          llms.txt  robots.txt  favicon.ico  .htaccess
    shared/
      src/TextJockey.php         the engine: 3 sentence-part regexes + random pick
      template.php               shared HTML page, driven by each app's $site array
      js/                        mootools + mootools-more
                                 (*-nc.js are the uncompressed sources, not served)
    data/
      bible.txt                  King James Bible, Project Gutenberg eBook #10
    tools/
      nanogenmo/                 NaNoGenMo 2014 novel generator (CLI, not deployed)
    archive/                     generated proofs + old zips (not deployed)

Both apps resolve `shared/` and `data/` **relative to their own location,
three levels up** (`__DIR__ . '/../../../...'`). The tree must therefore stay
intact on the server; the docroot is a subdirectory of the deployed tree, not
the top of it.

Server requirements
-------------------

* PHP (any reasonably modern version; the code is plain PHP, no Composer,
  no extensions beyond the defaults).
* The webserver must serve `apps/<site>/public` as the document root and
  follow symlinks for `js/` (Apache: `Options FollowSymLinks`).
  If symlinks are not an option, replace the `js` symlink with a real copy
  of `shared/js` during deployment.
* Sessions must work (`session_start()` is called to defeat Varnish caching
  on the ONI server — responses must not be cached).

Deployment flow
---------------

1. **Upload the whole tree** (minus `archive/` and `tools/` if you like) to
   the server, e.g.:

       rsync -avz --delete \
         --exclude '.git' --exclude 'archive' --exclude 'tools' \
         --exclude 'apps/neuropolis-n/public/cache/*' \
         ./ user@server:/path/to/tj/

   Mind the `cache/` exclude on the neuropolis side: the scraped texts live
   only on the server, so a `--delete` sync must not wipe them.

2. **Point each vhost's document root** at its app:

   | site               | document root                             |
   |--------------------|-------------------------------------------|
   | god-is-a-tj.com    | `/path/to/tj/apps/god-is-a-tj/public`     |
   | neuropolisn.com    | `/path/to/tj/apps/neuropolis-n/public`    |

3. **Per-site data:**
   * God is a TJ needs `data/bible.txt` (in git, deploys with the tree).
   * Neuropolis N needs scraped texts as
     `apps/neuropolis-n/public/cache/*.txt` on the server. Without them the
     endpoint answers `axel` (the wildcard/error token) and the page stays
     empty.

4. **Verify:** load each site in a browser — coloured text should start
   appearing within a couple of seconds (Neuropolis N deliberately paces
   itself with a 2-second sleep per line). The endpoints can be checked
   directly:

       curl -d sp=0 https://www.god-is-a-tj.com/getline.php
       curl -d sp=0 https://www.neuropolisn.com/getline.php

   Any non-`axel` text response means that site is healthy.

Notes
-----

* `getbibleline.php` no longer exists — both sites use `getline.php` since
  the 2026 restructuring. It is an XHR endpoint only; nothing external links
  to it.
* `.htaccess` (identical for both sites) disables mod_expires and sets
  `Cache-Control: public, must-revalidate` for HTML/PHP responses.
* The NaNoGenMo generator is run locally, not on the server:

      cd tools/nanogenmo && php generate.php

  It writes `text<timestamp>.txt` + `.pdf` into the current directory
  (gitignored) by fetching Douay-Rheims Bible books from Project Gutenberg
  mirrors — be gentle, Gutenberg rate-limits aggressive fetching.
