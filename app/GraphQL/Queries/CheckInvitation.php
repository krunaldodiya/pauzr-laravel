<?php

namespace App\GraphQL\Queries;

use App\Invitation;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CheckInvitation
{
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $sender_id = $context->request->segment(3);
        $mobile_cc = $context->request->segment(4);

        Invitation::firstOrCreate(
            ['mobile_cc' => $mobile_cc],
            ['sender_id' => $sender_id, 'mobile_cc' => $mobile_cc]
        );

        return redirect("https://play.google.com/store/apps/details?id=com.pauzr.org");
    }
}
