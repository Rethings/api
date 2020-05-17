<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Tests\Concerns;

trait HasJWT
{
    private static array $users = [
        // user-01
        'user-01' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJ1c2VyLTAxIiwiaWF0IjoxNTg5NjE3MTM1fQ.ium-9B23MSEk1tYtpXhQYhkPtToc3iD6ObaDYgmQ4oQkha2PDi7NUN5S_0hYq2OaNULJRDhqzXJuniUOO05KiVneTx-g9B9sJUgYIr7BzrZoQOjgdpN621-FAUrOK5uzwuXhu39FY9wZdUFibll2G7UZ0b_qxoDwm_yKa85dwc3gxelpamfJoG9n4JrKVAQsqfmKYL_HWDAGtH7aQEvkZLHptOhV91WP6Gmbt2KNvZ7RvPIJGVsdg3-tW_5XS9unSMAtEI9EfiQ6p8EvglztYn47mEByLSBRulws78QkB74niZwnpKbTXddSJuBmaDinFP5x1HR6erbQqXkmVEs7kg',
        // user-02
        'user-02' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJ1c2VyLTAyIiwiaWF0IjoxNTg5NjE3MTcyfQ.ZLAG34nyJPRmetQybv_4iRrta-ylg6m1Zu_2TlTK2V5cAgf4CpEWfGQGUpM1Je3clXNW4y8ZUJ9S5ND4V4CFkb7E_vwN1rbDWUFNWLyxUpaflpcyY1sQ4H9t4J7tt8IGbhO00hUTivUKR8FcbWE6OoUwptLpTW20gbsE5vvuam1bZR_UhQJoiK5TjnwSMN7ZEyR6F-xuR9zhQSEdojXEyfEFj_1rFJ7gSRf3OBYQpNyyZTKfWbSOEhK2XOkar9_gaZ8SnvUQlGbc3cSOBpIuiOQ3wXuPXDHi2POWkRpmHUj4jJQdutpsq7HV6EnOACD1h2dlE0RyZgpdfcL2hxfAnQ',
    ];

    private static array $consumers = [
        // consumer-01
        'consumer-01' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJjb25zdW1lci0wMSIsImlhdCI6MTU4OTYxNzIwN30.fcmtgq8q7r6TP97rPqp3u6_qedzdI3m5TtpHs-0GIGiwRZKV3ColecnkyPCyu63uK-0AdP6PM3-Hfu2UUGA2DN2xi0NpOaQpDRyZ8ImyUoEjmf_Q57ne4qp06qxFE-y9bFtCDuZ4KyXkiO-6Vob9LSdeBHB30oXSKHN80X4vm28SdGGCq5rm_nRCo6z4rPexO23x9eacnIFtIjK0VTkv9QS7Okee4X_9VJysGngQ11wa8edMd6L3-7cg-d7pTurH0QS3VI9HtUn38ZuVqKp45BMbIXBUJX-fKsIQYwwk8ywVD2qQ4X2TFAEcppQhqSafw3vZFowPzz7CxVEAWKMATQ',

        // consumer-02
        'consumer-02' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJjb25zdW1lci0wMiIsImlhdCI6MTU4OTYxNzIzMX0.cSCN6ekgEqujkrvCWTXsWhxMb7nTsbHusBStq43ga3XNh5rQkvv4KOCrC2JieRwj85qWNhvm_CQVxNlNwnlLX7EeZnhkO6CiBI0f5HIno_7L7bh0Xm-Yc_Ew45l7uT2K_L3TQK_-_oPm0Z6pxoCzuYjlxk2y8QWw3DygXm7LjEO7tEm81314ma6IgLTV-8MSD1kesq5y9wK86qD8O4k02WhdALhWvdEvbG5gCvgOA-CwBMndluJEutNnTDhZ38l4CSmeJ5olAehxvg3einaqFn69y31WmEX2uOzNvFuT4NBpvLE6RjgP5LoGeSWMZkumTEpCLRMS72b0Q4LnmoLdqA',
    ];

    public static function getUserToken(string $id = 'user-01'): string
    {
        return static::$users[$id];
    }

    public static function getConsumerToken(string $id = 'consumer-01')
    {
        return static::$consumers[$id];
    }

    public static function getUserAuthHeaders(string $id): array
    {
        return [
            'Authorization' => 'Bearer ' . static::getUserToken($id),
        ];
    }

    public static function getConsumerAuthHeaders(string $id, string $appId): array
    {
        return [
            'Authorization' => 'Bearer ' . static::getConsumerToken($id),
            'X-APP-ID' => $appId,
        ];
    }

    public static function getAppPublicKey(): string
    {
        return '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqONiQHqxjjI3gDr1xvVt
SDs/AZ4v40BrBflptJzG+fGE/+UFjQC96WMarTuB6PVm46UwEuD3QaCsHC1YaB1S
aEaql26KtbMOFKj/QTD2Zt5v01Wvc+7lTxu7LELJBzAfxod4FZ/F72bKhegmtsqI
tqLa0MbwlFDW7WjYfwAkuKuodN8CsqNr+BqcN2jfNTJPaT9T0usv1PSg/vcPdcE3
8h7rRIsAOnbodTw2emPiYxljm9V2PyXGI0rLqRdXBndAXorbKDH21zZDTr1ClvTg
Z42vPdFIRMaxlfSyKugQ6P9178acscc13j4rFzUuTel2UmgHWVfDShdhYdUm+Qs4
MQIDAQAB
-----END PUBLIC KEY-----
';
    }

    public static function getPlatformPublicKey(): string
    {
        return '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAo06p1zL0R0JOi/GS5rMi
WyOI8pfJdyHQyAkoxAsFCOA33VWg27bGiNUu8NXlPKi9m7KbpUgHdQQQ53pK8eg5
onc/1tY82bG9kzBp6Aprr9WPl+foF4yXpqtT5XCvrDyWi7y10IoPjExqpCQWzLyv
e0EN7C6SHgDp33r2FKEiQYbOj70iQ61md1jJLh6koCpsJ5f1RtPzKTApWOau6BUk
PbPd7AhQ01tA30Tq0o57BT1g+zyb2IfuCet+ovKgSL/igovj/F8B6rjnnpgxjExZ
Zl/VAVGmukOaUyAcDG99YSfDiPnsb5micFaDNaD8CCZNv/abNqMCcoiqv9OBAkJH
0QIDAQAB
-----END PUBLIC KEY-----
';
    }
}
