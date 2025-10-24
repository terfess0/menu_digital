class OrderStatus {
    const PENDING = 1;
    const IN_PREPARATION = 2;
    const DELIVERED = 3;
    const CANCELED = 4;

    public static function getStatusList() {
        return [
            self::PENDING => 'Pending',
            self::IN_PREPARATION => 'In Preparation',
            self::DELIVERED => 'Delivered',
            self::CANCELED => 'Canceled',
        ];
    }
}