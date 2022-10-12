<?php

namespace App\Utils;

abstract class Constants
{
    public const HOST_URL = 'https://lamacompta.co';

    public const MAX_IMAGE_FILE_SIZE = 307200; // 307 200 octets = 300 Kio (for Windows)
    public const MAX_OFFERS_TO_DISPLAY = 51;
    public const MAX_COMPANIES_TO_DISPLAY = 51;
    public const MAX_CITY_ID = 35854;

    public const LAMACOMPTA_PRIMARY_COLOR = '#0671FC';

    public const MAIL_CONTACT_TECH = 'killian@lamacompta.co';
    public const MAIL_CONTACT_ADMIN = 'jason@lamacompta.co';

    public const USER_ID_ADMIN = 2; // Jason
    public const USER_ID_TALENT_PLUG = 8;
    public const USER_ID_AIRTABLE = 9;
    public const USER_ID_BUBBLE = 10;

    public const COMPANY_TAG_SLUG = 'cabinets';
    public const OFFER_TAG_SLUG   = 'offres';
    public const BADGE_TAG_SLUG   = 'badge';
    public const TOOL_TAG_SLUG    = 'outil';

    public const POST_ID_EXAMPLE_COMPANY_PAGE = 845;
    public const POST_ID_EXAMPLE_OFFER_PAGE = 887;

    public const POST_ID_LAMACOMPTA_PAGE = 14578;
    public const POST_ID_LAMACOMPTA_OFFER = 17650;

    public const OFFERS_ID_TO_EXCLUDE = [
        self::POST_ID_EXAMPLE_OFFER_PAGE,
        self::POST_ID_LAMACOMPTA_OFFER
    ];

    public const LINK_RECRUTEMENT_LAMACOMPTA = 'https://recrutement.lamacompta.co';
    public const LINK_DEPOSER_CV = 'https://airtable.com/shrjIagSUMFf8qLMy';
    public const LINK_LOGIN_USER_ACCOUNT = 'https://app.lamacompta.co/signup_login';
    public const LINK_CREATE_USER_ACCOUNT = 'https://app.lamacompta.co/signup_login';
    public const LINK_REQUEST_DEMO = 'https://lamacompta.pipedrive.com/scheduler/ZA1rLGHb/demander-une-demo';

    public const CUSTOM_TABLE_FORMS_TOKENS = 'lca_custom_forms_tokens';
}
