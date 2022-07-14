# Portal API PHP Example

Portal API automates the signature gathering process via the Dokobit portal.

Check complete documentation [here](https://beta.dokobit.com/api/doc).

Request developer access token [here](https://www.dokobit.com/developers/request-token).

## Example configuration
- Set `$accessToken` variable in [`config.php`](https://github.com/dokobit/portal-api-php-example/config.php).

## Flow

### Create signing
[`create_signing.php`](https://github.com/dokobit/portal-api-php-example/create-signing.php) - PHP code example for creating a signing. It could be run from the web or CLI.
- Example will upload a file Resources/test.pdf to the Dokobit portal and create a signing.
- Multiple signers could be added.
- Notification to sign a document would be sent to the signer's `email`, if specified.
- If a `comment` is provided, users would get this message displayed in the notification email.
- If `email` is not set, a `code` must be provided.
- `require_account` parameter enables you to securely share a document with a specific person and allow this person to access the document without registering to the Dokobit portal. If `require_account` is set to `false` and `code` is provided, the signer would be asked to authenticate before viewing the document.
- Response would also return a link to check the signing status.
- Full list of available attributes can be found [here](https://beta.dokobit.com/api/doc#_api_signing_create).

### Sign
Once signing is created, users would be able to sign the document.
- If emails were provided in the creation of the signing - users would get an email notification with a direct link to sign the document.
- If `require_account` was set to `false`, users would be able to sign without registering a Dokobit account. Otherwise, the signing would be added to an existing account or the signer would be asked to register.

### Retrieving signed document
Document signing postback calls are triggered, if `postback_url` was set while creating a signing.
There are eight types of postback calls:
1. `signing_created` - Document signing created;
2. `signer_approved` - Document was approved;
3. `signer_declined` - Document signer has declined to sign the document;
4. `signer_signed` - Document signed by one of the signers;
5. `document_received` - Document delivery was confirmed by the receiver;
6. `signing_completed` - Document signed by all parties;
7. `signing_archived` - Signing archived successfully;
8. `signing_archive_failed` - Signing archiving failed.
More details can be found [here](https://support.dokobit.com/article/820-dokobit-webhooks).

[`postback-handler.php`](https://github.com/dokobit/portal-api-php-example/public/postback-handler.php) - PHP code example for handling postback calls. The file should be placed in the public web directory, accessible for Portal API.

To retrieve the signed document using these examples, you will need:
- Put [`postback-handler.php`](https://github.com/dokobit/portal-api-php-example/public/postback-handler.php) in a public web directory, accessible for Portal API.
- Set `$postbackUrl` parameter in `config.php` with URL where the `postback-handler.php` will be available. For, e.g. `http://your-public-host/postback-handler.php`.
- Create signing.
- Sign.
- Information about a signed document will be sent to the postback URL. `postback-handler.php` will handle postback, and the signed file will be stored in the dedicated directory.
- Log file `postback.log` containing postback information, will be placed in the dedicated directory.

## Helpful methods

[`share_signing.php <signing_token>`](https://github.com/dokobit/portal-api-php-example/share_signing.php) - Adds participant to an existing signing.

[`remove_signer.php <signing_token> <signer_token>`](https://github.com/dokobit/portal-api-php-example/remove_signer.php) - Removes the participant from an existing signing, only if a person has not signed the document yet.

[`remind.php <signing_token> <signer_token>`](https://github.com/dokobit/portal-api-php-example/remind.php) - Sends reminder to participant.

[`delete_signing.php`](https://github.com/dokobit/portal-api-php-example/delete_signing.php) - delets a specific signing. Once the document is signed and you have downloaded the file to save it on your end, you could choose to delete the signing from the Dokobit portal. Signing can be deleted only from your organisation. Document deletion is permanent and cannot be undone:
- [`delete_signing.php <signing_token>`](https://github.com/dokobit/portal-api-php-example/delete_signing.php) - Makes a request to [POST /api/signing/{token}/delete.json](https://beta.dokobit.com/api/doc#_api_signing_delete) endpoint. The document will be removed from your account. It will remain accessible to other participants in the signing.
- [`delete_signing.php <signing_token> all`](https://github.com/dokobit/portal-api-php-example/delete_signing.php) - Makes a request to [POST /api/signing/{token}/delete-all.json](https://beta.dokobit.com/api/doc#_api_signing_delete-all) endpoint and if executed successfully, the document will be removed from your account and from other participant accounts' you have shared it with, only if a person has not signed the document yet.

[`list_signings.php`](https://github.com/dokobit/portal-api-php-example/list_signings.php) - Retrieves a list of signings associated with the account.

[`signing_status.php <signing_token>`](https://github.com/dokobit/portal-api-php-example/signing_status.php) - Retrieves status and information about a specific signing.

[`download_signing.php <signing_token>`](https://github.com/dokobit/portal-api-php-example/download_signing.php) - Downloads and saves the signed file.
