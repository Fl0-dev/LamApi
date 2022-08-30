<?php

namespace App\Controller;

use App\Entity\Company\CompanyGroup;
use App\Repository\CompanyRepositories\CompanyGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CompanyGroupController extends AbstractController
{
    public function __construct(private CompanyGroupRepository $companyGroupRepository)
    {
    }

    public function __invoke(Request $request)
    {

        $operationName = $request->attributes->get('_api_item_operation_name');
        if (!$operationName) {
            $operationName = $request->attributes->get('_api_collection_operation_name');
        }

        if ($operationName === CompanyGroup::OPERATION_NAME_COUNT_COMPANY_GROUPS) {
            $count = count($this->companyGroupRepository->findAll());
            if (!$count) {
                return 0;
            }
            return $count;
        }

        if ($operationName === CompanyGroup::OPERATION_NAME__GET_COMPANY_NAME_BY_KEYWORDS) {
            $keywords = strtolower($request->get('keywords'));
            $keywords = trim($keywords);
            return $this->companyGroupRepository->findNameByPartialSlug($keywords);
        }
    }
}
