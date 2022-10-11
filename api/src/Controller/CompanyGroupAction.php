<?php

namespace App\Controller;

use App\Repository\CompanyRepositories\CompanyGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CompanyGroupAction extends AbstractController
{
    const ENDPOINT_FOR_COMPANY_GROUP_BY_KEYWORD = '_api_/company-groups/name/keywords={keywords}_get_collection';
    const ENDPOINT_FOR_COMPANY_GROUP_COUNT = '_api_/count-company-groups_get';

    public function __construct(private CompanyGroupRepository $companyGroupRepository)
    {
    }

    public function __invoke(Request $request): int|array|null
    {
        $endpoint = $request->attributes->get('_route');

        if ($endpoint === self::ENDPOINT_FOR_COMPANY_GROUP_BY_KEYWORD) {
            $keywords = strtolower($request->get('keywords'));
            $keywords = trim($keywords);

            return $this->companyGroupRepository->findNameByPartialSlug($keywords);
        }

        if ($endpoint === self::ENDPOINT_FOR_COMPANY_GROUP_COUNT) {
            $count = count($this->companyGroupRepository->findAll());

            if (!$count) {
                return 0;
            }

            return $count;
        }

        return null;
    }
}
