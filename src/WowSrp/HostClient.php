<?php

declare(strict_types=1);

namespace App\WowSrp;

use Exception;
use phpseclib3\Math\BigInteger;

final class HostClient extends Client
{
    private BigInteger $verifier;

    /**
     * HostClient constructor.
     *
     * @param string     $identity
     * @param string     $salt
     * @param string     $verifier
     * @param string     $clientPublicEphemeralValue
     * @param array|null $options
     */
    public function __construct(
        string $identity,
        string $salt,
        string $verifier,
        string $clientPublicEphemeralValue,
        ?array $options = null
    ) {
        $this->clientPublicEphemeralValue = new BigInteger($clientPublicEphemeralValue, 16);
        $this->verifier                   = new BigInteger($verifier, 16);

        parent::__construct($identity, $salt, $options);
    }

    /**
     * Returns hex of public ephemeral value
     *
     * @return string
     * @throws Exception
     */
    public function getPublicEphemeralValue(): string
    {
        $this->hostPublicEphemeralValue = $this->generateEphemeralValues();

        return $this->hostPublicEphemeralValue->toHex();
    }

    /**
     *
     */
    public function calculateSessionKey(): void
    {
        // Random scrambling parameter
        $u   = $this->computeRandomScramblingParameter();
        $avu = $this->clientPublicEphemeralValue->multiply($this->verifier->powMod($u, $this->N));

        // Session key
        $this->sessionKey = $avu->powMod($this->secretEphemeralValue, $this->N);

        // Strong session key
        $this->strongSessionKey = sha1($this->sessionKey->toHex());
    }

    /**
     * @param BigInteger $value Host's secret ephemeral value
     *
     * @return BigInteger Host's public ephemeral value
     */
    public function computePublicEphemeralValue(BigInteger $value): BigInteger
    {
        return $this->multiplier->multiply($this->verifier)->add($this->g->powMod($value, $this->N))->modPow(new BigInteger(1), $this->N);
    }

    public function validateClientSessionKeyProof(string $proof): bool
    {
        return $this->computeClientSessionKeyProof() === $proof;
    }
}
