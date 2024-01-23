from bank import value

def test_hello():
    assert value("Hello, how are you?") == 0

def test_h():
    assert value("How are you today?") == 20

def test_fail():
    assert value("What's up ?") == 100

