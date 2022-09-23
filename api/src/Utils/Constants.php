<?php
namespace App\Utils;

abstract class Constants
{
    const HOST_URL = 'https://lamacompta.co';

    const MAX_IMAGE_FILE_SIZE = 307200; // 307 200 octets = 300 Kio (for Windows)
    const MAX_OFFERS_TO_DISPLAY = 51;
    const MAX_COMPANIES_TO_DISPLAY = 51;
    const MAX_CITY_ID = 35854;

    const LAMACOMPTA_PRIMARY_COLOR = '#0671FC';

    const MAIL_CONTACT_TECH = 'killian@lamacompta.co';
    const MAIL_CONTACT_ADMIN = 'jason@lamacompta.co';

    const USER_ID_ADMIN = 2; // Jason
    const USER_ID_TALENT_PLUG = 8;
    const USER_ID_AIRTABLE = 9;
    const USER_ID_BUBBLE = 10;

    const COMPANY_TAG_SLUG = 'cabinets';
    const OFFER_TAG_SLUG   = 'offres';
    const BADGE_TAG_SLUG   = 'badge';
    const TOOL_TAG_SLUG    = 'outil';

    const POST_ID_EXAMPLE_COMPANY_PAGE = 845;
    const POST_ID_EXAMPLE_OFFER_PAGE = 887;

    const POST_ID_LAMACOMPTA_PAGE = 14578;
    const POST_ID_LAMACOMPTA_OFFER = 17650;

    const OFFERS_ID_TO_EXCLUDE = [
        self::POST_ID_EXAMPLE_OFFER_PAGE,
        self::POST_ID_LAMACOMPTA_OFFER
    ];

    const LINK_RECRUTEMENT_LAMACOMPTA = 'https://recrutement.lamacompta.co';
    const LINK_DEPOSER_CV = 'https://airtable.com/shrjIagSUMFf8qLMy';
    const LINK_LOGIN_USER_ACCOUNT = 'https://app.lamacompta.co/signup_login';
    const LINK_CREATE_USER_ACCOUNT = 'https://app.lamacompta.co/signup_login';
    const LINK_REQUEST_DEMO = 'https://lamacompta.pipedrive.com/scheduler/ZA1rLGHb/demander-une-demo';

    const CUSTOM_TABLE_FORMS_TOKENS = 'lca_custom_forms_tokens';
}
