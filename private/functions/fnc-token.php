<?php

/**
 * Get Token
 * Generate and return a token string
 * @return (string) Token
 */
function getToken() {
    return md5(uniqid());
}