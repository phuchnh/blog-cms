# blog-cms

# run to create jwt key for cookie
> php artisan jwt:secret

# install storage link
> php artisan storage:link

# install seo package
> php artisan vendor:publish --provider="Artesaos\SEOTools\Providers\SEOToolsServiceProvider"

# publish config/newsletter for Newsletter package
> php artisan vendor:publish --provider="Spatie\Newsletter\NewsletterServiceProvider"

# add config Mailchimp
MAILCHIMP_APIKEY=
MAILCHIMP_LIST_ID=