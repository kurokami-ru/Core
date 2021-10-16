<?php

namespace Core\Comm\HTTP;

interface ResponseStatusInterface
{
    // Informational 1xx
    const STATUS_CONTINUE = 100;
    const STATUS_SWITCHING_PROTOCOLS = 101;
    const STATUS_PROCESSING = 102;
    const STATUS_EARLY_HINTS = 103;
    // Successful 2xx
    const STATUS_OK = 200;
    const STATUS_CREATED = 201;
    const STATUS_ACCEPTED = 202;
    const STATUS_NON_AUTHORITATIVE_INFORMATION = 203;
    const STATUS_NO_CONTENT = 204;
    const STATUS_RESET_CONTENT = 205;
    const STATUS_PARTIAL_CONTENT = 206;
    const STATUS_MULTI_STATUS = 207;
    const STATUS_ALREADY_REPORTED = 208;
    const STATUS_IM_USED = 226;
    // Redirection 3xx
    const STATUS_MULTIPLE_CHOICES = 300;
    const STATUS_MOVED_PERMANENTLY = 301;
    const STATUS_FOUND = 302;
    const STATUS_SEE_OTHER = 303;
    const STATUS_NOT_MODIFIED = 304;
    const STATUS_USE_PROXY = 305;
    const STATUS_RESERVED = 306;
    const STATUS_TEMPORARY_REDIRECT = 307;
    const STATUS_PERMANENT_REDIRECT = 308;
    // Client Errors 4xx
    const STATUS_BAD_REQUEST = 400;
    const STATUS_UNAUTHORIZED = 401;
    const STATUS_PAYMENT_REQUIRED = 402;
    const STATUS_FORBIDDEN = 403;
    const STATUS_NOT_FOUND = 404;
    const STATUS_METHOD_NOT_ALLOWED = 405;
    const STATUS_NOT_ACCEPTABLE = 406;
    const STATUS_PROXY_AUTHENTICATION_REQUIRED = 407;
    const STATUS_REQUEST_TIMEOUT = 408;
    const STATUS_CONFLICT = 409;
    const STATUS_GONE = 410;
    const STATUS_LENGTH_REQUIRED = 411;
    const STATUS_PRECONDITION_FAILED = 412;
    const STATUS_REQUEST_ENTITY_TOO_LARGE = 413;
    const STATUS_URI_TOO_LONG = 414;
    const STATUS_UNSUPPORTED_MEDIA_TYPE = 415;
    const STATUS_RANGE_NOT_SATISFIABLE = 416;
    const STATUS_EXPECTATION_FAILED = 417;
    const STATUS_IM_A_TEAPOT = 418;
    const STATUS_MISDIRECTED_REQUEST = 421;
    const STATUS_UNPROCESSABLE_ENTITY = 422;
    const STATUS_LOCKED = 423;
    const STATUS_FAILED_DEPENDENCY = 424;
    const STATUS_TOO_EARLY = 425;
    const STATUS_UPGRADE_REQUIRED = 426;
    const STATUS_PRECONDITION_REQUIRED = 428;
    const STATUS_TOO_MANY_REQUESTS = 429;
    const STATUS_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    const STATUS_UNAVAILABLE_FOR_LEGAL_REASONS = 451;
    // Server Errors 5xx
    const STATUS_INTERNAL_SERVER_ERROR = 500;
    const STATUS_NOT_IMPLEMENTED = 501;
    const STATUS_BAD_GATEWAY = 502;
    const STATUS_SERVICE_UNAVAILABLE = 503;
    const STATUS_GATEWAY_TIMEOUT = 504;
    const STATUS_VERSION_NOT_SUPPORTED = 505;
    const STATUS_VARIANT_ALSO_NEGOTIATES = 506;
    const STATUS_INSUFFICIENT_STORAGE = 507;
    const STATUS_LOOP_DETECTED = 508;
    const STATUS_NOT_EXTENDED = 510;
    const STATUS_NETWORK_AUTHENTICATION_REQUIRED = 511;

	const REASONS = [
		//Informational 1xx
		self::STATUS_CONTINUE => 'Continue',
		self::STATUS_SWITCHING_PROTOCOLS => 'Switching Protocols',
		self::STATUS_PROCESSING => 'Processing',
		//Successful 2xx
		self::STATUS_OK => 'OK',
		self::STATUS_CREATED => 'Created',
		self::STATUS_ACCEPTED => 'Accepted',
		self::STATUS_NON_AUTHORITATIVE_INFORMATION => 'Non-Authoritative Information',
		self::STATUS_NO_CONTENT => 'No Content',
		self::STATUS_RESET_CONTENT => 'Reset Content',
		self::STATUS_PARTIAL_CONTENT => 'Partial Content',
		self::STATUS_MULTI_STATUS => 'Multi-Status',
		self::STATUS_ALREADY_REPORTED => 'Already Reported',
		self::STATUS_IM_USED => 'IM Used',
		//Redirection 3xx
		self::STATUS_MULTIPLE_CHOICES => 'Multiple Choices',
		self::STATUS_MOVED_PERMANENTLY => 'Moved Permanently',
		self::STATUS_FOUND => 'Found',
		self::STATUS_SEE_OTHER => 'See Other',
		self::STATUS_NOT_MODIFIED => 'Not Modified',
		self::STATUS_USE_PROXY => 'Use Proxy',
		self::STATUS_RESERVED => '(Reserved)',
		self::STATUS_TEMPORARY_REDIRECT => 'Temporary Redirect',
		self::STATUS_PERMANENT_REDIRECT => 'Permanent Redirect',
		//Client Error 4xx
		self::STATUS_BAD_REQUEST => 'Bad Request',
		self::STATUS_UNAUTHORIZED => 'Unauthorized',
		self::STATUS_PAYMENT_REQUIRED => 'Payment Required',
		self::STATUS_FORBIDDEN => 'Forbidden',
		self::STATUS_NOT_FOUND => 'Not Found',
		self::STATUS_METHOD_NOT_ALLOWED => 'Method Not Allowed',
		self::STATUS_NOT_ACCEPTABLE => 'Not Acceptable',
		self::STATUS_PROXY_AUTHENTICATION_REQUIRED => 'Proxy Authentication Required',
		self::STATUS_REQUEST_TIMEOUT => 'Request Timeout',
		self::STATUS_CONFLICT => 'Conflict',
		self::STATUS_GONE => 'Gone',
		self::STATUS_LENGTH_REQUIRED => 'Length Required',
		self::STATUS_PRECONDITION_FAILED => 'Precondition Failed',
		self::STATUS_REQUEST_ENTITY_TOO_LARGE => 'Request Entity Too Large',
		self::STATUS_URI_TOO_LONG => 'Request-URI Too Long',
		self::STATUS_UNSUPPORTED_MEDIA_TYPE => 'Unsupported Media Type',
		self::STATUS_RANGE_NOT_SATISFIABLE => 'Requested Range Not Satisfiable',
		self::STATUS_EXPECTATION_FAILED => 'Expectation Failed',
		self::STATUS_IM_A_TEAPOT => 'I\'m a teapot',
		self::STATUS_MISDIRECTED_REQUEST => 'Misdirected Request',
		self::STATUS_UNPROCESSABLE_ENTITY => 'Unprocessable Entity',
		self::STATUS_LOCKED => 'Locked',
		self::STATUS_FAILED_DEPENDENCY => 'Failed Dependency',
		self::STATUS_UPGRADE_REQUIRED => 'Upgrade Required',
		self::STATUS_PRECONDITION_REQUIRED => 'Precondition Required',
		self::STATUS_TOO_MANY_REQUESTS => 'Too Many Requests',
		self::STATUS_REQUEST_HEADER_FIELDS_TOO_LARGE => 'Request Header Fields Too Large',
		self::STATUS_TOO_MANY_REQUESTS => 'Connection Closed Without Response',
		self::STATUS_UNAVAILABLE_FOR_LEGAL_REASONS => 'Unavailable For Legal Reasons',
		//self::STATUS_CLIENT_CLOSED_REQUEST => 'Client Closed Request',
		//Server Error 5xx
		self::STATUS_INTERNAL_SERVER_ERROR => 'Internal Server Error',
		self::STATUS_NOT_IMPLEMENTED => 'Not Implemented',
		self::STATUS_BAD_GATEWAY => 'Bad Gateway',
		self::STATUS_SERVICE_UNAVAILABLE => 'Service Unavailable',
		self::STATUS_GATEWAY_TIMEOUT => 'Gateway Timeout',
		self::STATUS_VERSION_NOT_SUPPORTED => 'HTTP Version Not Supported',
		self::STATUS_VARIANT_ALSO_NEGOTIATES => 'Variant Also Negotiates',
		self::STATUS_INSUFFICIENT_STORAGE => 'Insufficient Storage',
		self::STATUS_LOOP_DETECTED => 'Loop Detected',
		self::STATUS_NOT_EXTENDED => 'Not Extended',
		self::STATUS_NETWORK_AUTHENTICATION_REQUIRED => 'Network Authentication Required'//,
		//self::STATUS_NETWORK_CONNECTION_TIMEOUT_ERROR => 'Network Connect Timeout Error'
	];
}
?>